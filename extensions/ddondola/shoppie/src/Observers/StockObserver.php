<?php

namespace Shoppie\Observers;

use Shoppie\Stock;

class StockObserver
{
    /**
     * Handle the Stock "created" event.
     *
     * @param  \Shoppie\Stock  $stock
     * @return void
     */
    public function created(Stock $stock)
    {
        //
    }

    /**
     * Handle the Stock "updated" event.
     *
     * @param  \Shoppie\Stock  $stock
     * @return void
     */
    public function updated(Stock $stock)
    {
        //
    }

    /**
     * Handle the Stock "deleted" event.
     *
     * @param  \Shoppie\Stock  $stock
     * @return void
     */
    public function deleted(Stock $stock)
    {
        //
    }

    /**
     * Handle the Stock "restored" event.
     *
     * @param  \Shoppie\Stock  $stock
     * @return void
     */
    public function restored(Stock $stock)
    {
        //
    }

    /**
     * Handle the Stock "force deleted" event.
     *
     * @param  \Shoppie\Stock  $stock
     * @return void
     */
    public function forceDeleted(Stock $stock)
    {
        //
    }
}
