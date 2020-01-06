<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 04/01/2020
 * Time: 21:04
 */

namespace Shoppie\Broadcasting;


use Ddondola\User;
use Shoppie\Order;
use Shoppie\Shop;

class ShopOrderChannel
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
     * @param Shop $shop
     * @param Order $order
     * @return boolean
     */
    public function join(User $user, Shop $shop, Order $order)
    {
        return $user->manages($shop) && $order->isHandledBy($shop);
    }
}