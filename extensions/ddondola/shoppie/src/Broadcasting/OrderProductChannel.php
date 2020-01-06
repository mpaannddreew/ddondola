<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 04/01/2020
 * Time: 20:51
 */

namespace Shoppie\Broadcasting;


use Ddondola\User;
use Shoppie\Order;
use Shoppie\Product;

class OrderProductChannel
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param  User $user
     * @param Order $order
     * @param Product $product
     * @return boolean
     */
    public function join(User $user, Order $order, Product $product)
    {
        return $user->is($order->by) && $order->hasProduct($product);
    }
}