<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 04/01/2020
 * Time: 20:52
 */

namespace Shoppie\Broadcasting;


use Ddondola\User;
use Shoppie\Order;
use Shoppie\Product;
use Shoppie\Shop;

class ShopOrderProductChannel
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
     * @param Product $product
     * @return boolean
     */
    public function join(User $user, Shop $shop, Order $order, Product $product)
    {
        return $user->manages($shop) && $shop->is($product->shop) && $order->isHandledBy($shop) && $order->hasProduct($product);
    }
}