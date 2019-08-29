<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 29/08/2019
 * Time: 11:06
 */

namespace Shoppie;


use Bank\Jobs\CreateEscrow;
use Illuminate\Database\Eloquent\Model;
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
                    return false;
                }
            }

            $cart->products()->updateExistingPivot($product, ['quantity' => $quantity]);
            return true;
        }else {
            if ($product->quantity() >= (int)$quantity) {
                $cart->products()->attach($product, [
                    'quantity' => $quantity,
                    'price' => $product->discountedPrice()
                ]);
                return true;
            }
        }
        return false;
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

        return false;
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

//            CreateEscrow::dispatch($order);

            return $order;
        }

        return null;
    }

    /**
     * Check if user manages shop
     *
     * @param Model $seller
     * @param Shop $shop
     * @return bool
     */
    public function manages(Model $seller, Shop $shop)
    {
        // todo actual shop management implementation
        return $seller->is($shop->owner);
    }
}