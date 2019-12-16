<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 14/12/2019
 * Time: 22:52
 */

namespace Shoppie\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Shoppie\Cart;

class CartUpdated implements ShouldBroadcast, ShouldQueue
{
    /**
     * @var Cart
     */
    protected $cart;

    /**
     * CartUpdated constructor.
     * @param Cart $cart
     */
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|\Illuminate\Broadcasting\Channel[]
     */
    public function broadcastOn()
    {
        return new PrivateChannel('user.' . $this->cart->user->code);
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'cart.update';
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'count' => $this->cart->productCount()
        ];
    }
}