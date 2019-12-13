<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 12/12/2019
 * Time: 18:51
 */

Broadcast::channel('order.{order}', \Shoppie\Broadcasting\OrderChannel::class);
Broadcast::channel('shop.{shop}', \Shoppie\Broadcasting\ShopChannel::class);