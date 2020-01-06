<?php

namespace Shoppie\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Shoppie\Order;
use Shoppie\Product;
use Shoppie\Shop;

class OrderRowUpdated implements ShouldBroadcast, ShouldQueue
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Order
     */
    protected $order;

    /**
     * @var Product
     */
    protected  $product;

    /**
     * Create a new event instance.
     *
     * @param Order $order
     * @param Product $product
     */
    public function __construct(Order $order, Product $product)
    {
        $this->order = $order;
        $this->product = $product;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        $channels = array_merge(
            $this->order->handlers()->map(function (Shop $shop) {
                return new PrivateChannel('order.' . $shop->code . '.' . $this->order->code . '.' . $this->product->code);
            })->all(),
            [new PrivateChannel('order.' . $this->order->code . '.' . $this->product->code)]
        );

        return $channels;
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'order.row.updated';
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'product' => $this->product->code
        ];
    }
}
