<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 12/12/2019
 * Time: 20:24
 */

namespace Shoppie\Broadcasting;


use Ddondola\User;
use Shoppie\Shop;

class ShopChannel
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
     * @return boolean
     */
    public function join(User $user, Shop $shop)
    {
        return $user->manages($shop);
    }
}