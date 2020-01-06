<?php

namespace Shoppie\Observers;

use Shoppie\Events\NewOrder;
use Shoppie\Events\OrderUpdated;
use Shoppie\Order;

class OrderObserver
{
    /**
     * Handle the order "created" event.
     *
     * @param  \Shoppie\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        broadcast(new NewOrder($order));
    }

    /**
     * Handle the order "updated" event.
     *
     * @param  \Shoppie\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        broadcast(new OrderUpdated($order));
    }

    /**
     * Handle the order "deleted" event.
     *
     * @param  \Shoppie\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the order "restored" event.
     *
     * @param  \Shoppie\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the order "force deleted" event.
     *
     * @param  \Shoppie\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
