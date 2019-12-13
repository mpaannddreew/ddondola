<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 12/12/2019
 * Time: 18:53
 */

namespace Shoppie\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Shoppie\Order;
use Shoppie\Shop;

class NewOrder implements ShouldBroadcast, ShouldQueue
{
    /**
     * @var Order
     */
    protected $order;

    /**
     * NewMessage constructor.
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|\Illuminate\Broadcasting\Channel[]
     */
    public function broadcastOn()
    {
        $channels = $this->order->handlers()->map(function (Shop $shop) {
            return new PrivateChannel('shop.' . $shop->code);
        })->all();

        return $channels;
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'new.order';
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [];
    }
}