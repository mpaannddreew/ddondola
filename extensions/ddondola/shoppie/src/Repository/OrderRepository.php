<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2018-09-14
 * Time: 8:15 PM
 */

namespace Shoppie\Repository;


use Shoppie\Cart;
use Shoppie\Order;
use Shoppie\Product;


class OrderRepository
{
    /**
     * Get order from id
     *
     * @param $id
     * @return Order
     */
    public function id($id) {
        return Order::find($id);
    }

    /**
     * Get order from code
     *
     * @param $code
     * @return Order
     */
    public function code($code) {
        return Order::where('code', $code)->first();
    }

    /**
     * Create new order
     *
     * @param Cart $cart
     * @return Order
     */
    public function create(Cart $cart) {
        $order = $cart->user->orders()->create([]);
        $cart->products->each(function (Product $product) use ($order){
            $order->products()->attach($product, [
                'price' => $product->cartPivot->price,
                'quantity' => $product->cartPivot->quantity
            ]);
        });
        return $order;
    }
}