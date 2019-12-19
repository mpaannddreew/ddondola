<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 29/08/2019
 * Time: 11:06
 */

namespace Shoppie;


use Ddondola\User;
use Illuminate\Database\Eloquent\Model;
use Shoppie\Events\CartUpdated;
use Shoppie\Events\NewOrder;
use Shoppie\Events\ProductUnfavorited;
use Shoppie\Repository\CartRepository;
use Shoppie\Repository\OrderRepository;

class Shoppie
{
    /**
     * @var OrderRepository
     */
    protected $orders;

    /**
     * @var CartRepository
     */
    protected $carts;

    /**
     * Shoppie constructor.
     * @param OrderRepository $orders
     * @param CartRepository $carts
     */
    public function __construct(OrderRepository $orders, CartRepository $carts)
    {
        $this->orders = $orders;
        $this->carts = $carts;
    }

    /**
     * @param Model $buyer
     * @return Cart
     */
    public function createCart(Model $buyer) {
        if (is_null($buyer->cart)) {
            return $this->carts->create($buyer, []);
        }

        return $buyer->cart;
    }

    /**
     * Add product to cart
     *
     * @param Cart $cart
     * @param Product $product
     * @param $quantity
     * @return boolean
     */
    public function addCartProduct(Cart $cart, Product $product, $quantity) {
        if ($cart->hasProduct($product)) {
            $current_quantity = (int)$cart->currentProductQuantity($product);
            if ((int)$quantity > $current_quantity) {
                $quantity_diff = (int)$quantity - $current_quantity;
                if ($quantity_diff > $product->quantity()) {
                    // todo notify low quantity
                }
            }

            $cart->products()->updateExistingPivot($product, ['quantity' => $quantity]);
        }else {
            if ($product->quantity() >= (int)$quantity) {
                $cart->products()->attach($product, [
                    'quantity' => $quantity,
                    'price' => $product->discountedPrice()
                ]);
            }
        }

        $cart = $this->carts->id($cart->getKey());
        broadcast(new CartUpdated($cart));

        return $cart->hasProduct($product);
    }

    /**
     * Remove product from cart
     *
     * @param Cart $cart
     * @param Product $product
     * @return boolean
     */
    public function removeCartProduct(Cart $cart, Product $product) {
        if ($cart->hasProduct($product)) {
            $cart->products()->detach($product);
        }

        $cart = $this->carts->id($cart->getKey());
        broadcast(new CartUpdated($cart));

        return $cart->hasProduct($product);
    }

    /**
     * Place new order
     *
     * @param Cart $cart
     * @return Order|null
     */
    public function checkOut(Cart $cart) {
        if (!$cart->isEmpty()) {
            $order = $this->orders->create($cart->user, []);
            $cart->products->each(function (Product $product) use ($order){
                $order->products()->attach($product, [
                    'price' => $product->cartPivot->price,
                    'quantity' => $product->cartPivot->quantity
                ]);
            });

            $cart->makeEmpty();
            $order = $this->orders->id($order->getKey());
            broadcast(new NewOrder($order));

            return $order;
        }

        return null;
    }

    /**
     * Check if user manages shop
     *
     * @param User $seller
     * @param Shop $shop
     * @return bool
     */
    public function manages(User $seller, Shop $shop)
    {
        // todo actual shop management implementation
        return $seller->is($shop->owner);
    }

    /**
     * @param Order $order
     * @param Product $product
     * @param array $attributes
     * @return Product
     */
    public function updateOrder(Order $order, Product $product, array $attributes) {
        // todo create observer for pivot
        $order->products()->updateExistingPivot($product, $attributes);

        return $product;
    }

    /**
     * @param User $user
     * @param Shop $shop
     * @return bool
     * @throws \Exception
     */
    public function like(User $user, Shop $shop) {
        if (!$this->likeStatus($user, $shop)) {
            $user->like($shop);
        } else {
            $user->unlike($shop);
        }

        return $this->likeStatus($user, $shop);
    }

    /**
     * @param User $user
     * @param Shop $shop
     * @return bool
     */
    public function likeStatus(User $user, Shop $shop) {
        return $user->hasLiked($shop);
    }

    /**
     * @param User $user
     * @param Product $product
     * @return bool
     */
    public function favorite(User $user, Product $product) {
        if (!$this->favoriteStatus($user, $product)) {
            $user->favorite($product);
        } else {
            $user->unfavorite($product);
            broadcast(new ProductUnfavorited($user, $product));
        }

        return $this->favoriteStatus($user, $product);
    }

    /**
     * @param User $user
     * @param Product $product
     * @return bool
     */
    public function favoriteStatus(User $user, Product $product) {
        return $user->hasFavorited($product);
    }
}