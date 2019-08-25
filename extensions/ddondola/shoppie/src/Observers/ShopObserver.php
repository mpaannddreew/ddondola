<?php

namespace Shoppie\Observers;

use Shoppie\Shop;

class ShopObserver
{
    /**
     * Handle the Shop "created" event.
     *
     * @param  \Shoppie\Shop  $shop
     * @return void
     */
    public function created(Shop $shop)
    {
        $shop->setUp();
    }

    /**
     * Handle the Shop "updated" event.
     *
     * @param  \Shoppie\Shop  $shop
     * @return void
     */
    public function updated(Shop $shop)
    {
        //
    }

    /**
     * Handle the Shop "deleted" event.
     *
     * @param  \Shoppie\Shop  $shop
     * @return void
     */
    public function deleted(Shop $shop)
    {
        //
    }

    /**
     * Handle the Shop "restored" event.
     *
     * @param  \Shoppie\Shop  $shop
     * @return void
     */
    public function restored(Shop $shop)
    {
        //
    }

    /**
     * Handle the Shop "force deleted" event.
     *
     * @param  \Shoppie\Shop  $shop
     * @return void
     */
    public function forceDeleted(Shop $shop)
    {
        //
    }
}
