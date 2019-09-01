<?php

namespace Shoppie\Observers;

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
        //
    }

    /**
     * Handle the order "updated" event.
     *
     * @param  \Shoppie\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        // todo broadcast order update
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
