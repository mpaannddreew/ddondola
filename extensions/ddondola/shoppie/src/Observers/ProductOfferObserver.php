<?php

namespace Shoppie\Observers;

use Shoppie\ProductOffer;

class ProductOfferObserver
{
    /**
     * Handle the ProductOffer "created" event.
     *
     * @param  \Shoppie\ProductOffer  $productOffer
     * @return void
     */
    public function created(ProductOffer $productOffer)
    {
        //
    }

    /**
     * Handle the ProductOffer "updated" event.
     *
     * @param  \Shoppie\ProductOffer  $productOffer
     * @return void
     */
    public function updated(ProductOffer $productOffer)
    {
        //
    }

    /**
     * Handle the ProductOffer "deleted" event.
     *
     * @param  \Shoppie\ProductOffer  $productOffer
     * @return void
     */
    public function deleted(ProductOffer $productOffer)
    {
        //
    }

    /**
     * Handle the ProductOffer "restored" event.
     *
     * @param  \Shoppie\ProductOffer  $productOffer
     * @return void
     */
    public function restored(ProductOffer $productOffer)
    {
        //
    }

    /**
     * Handle the ProductOffer "force deleted" event.
     *
     * @param  \Shoppie\ProductOffer  $productOffer
     * @return void
     */
    public function forceDeleted(ProductOffer $productOffer)
    {
        //
    }
}
