<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 12/12/2019
 * Time: 19:38
 */

namespace Shoppie\Broadcasting;


use Ddondola\User;
use Shoppie\Order;

class OrderChannel
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
     * @return boolean
     */
    public function join(User $user, Order $order)
    {
        return $user->is($order->by) || $user->handlesOrderViaShop($order);
    }
}