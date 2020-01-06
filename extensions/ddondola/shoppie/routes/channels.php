<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 12/12/2019
 * Time: 18:51
 */

Broadcast::channel('order.{order}', \Shoppie\Broadcasting\OrderChannel::class);
Broadcast::channel('order.{shop}.{order}', \Shoppie\Broadcasting\ShopOrderChannel::class);
Broadcast::channel('order.{order}.{product}', \Shoppie\Broadcasting\OrderProductChannel::class);
Broadcast::channel('order.{shop}.{order}.{product}', \Shoppie\Broadcasting\ShopOrderProductChannel::class);
Broadcast::channel('shop.{shop}', \Shoppie\Broadcasting\ShopChannel::class);