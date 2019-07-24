<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2018-10-12
 * Time: 11:24 AM
 */

namespace Shoppie\Repository;


use Illuminate\Database\Eloquent\Model;
use Shoppie\Cart;
use Shoppie\Order;
use Shoppie\Product;

class CartRepository
{
    /**
     * @var OrderRepository
     */
    protected $orders;

    /**
     * CartRepository constructor.
     * @param OrderRepository $orders
     */
    public function __construct(OrderRepository $orders)
    {
        $this->orders = $orders;
    }

    /**
     * @param Model $buyer
     * @return Cart
     */
    public function create(Model $buyer) {
        if (is_null($buyer->cart)) {
            return $buyer->cart()->save(new Cart([]));
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
    public function addProduct(Cart $cart, Product $product, $quantity) {
        if ($cart->hasProduct($product)) {
            $current_quantity = (int)$cart->currentProductQuantity($product);
            if ((int)$quantity > $current_quantity) {
                $quantity_diff = (int)$quantity - $current_quantity;
                if ($quantity_diff > $product->quantity()) {
                    return false;
                }
            }

            $cart->products()->updateExistingPivot($product->id, ['quantity' => $quantity]);
            return true;
        }else {
            if ($product->quantity() >= (int)$quantity) {
                $cart->products()->attach($product->id, [
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
    public function removeProduct(Cart $cart, Product $product) {
        if ($cart->hasProduct($product)) {
            $cart->products()->detach([$product->id]);
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
            $order = $this->orders->create($cart);
            $cart->makeEmpty();
            return $order;
        }

        return null;
    }
}