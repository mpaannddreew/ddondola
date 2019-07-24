<?php

namespace Shoppie\Observers;

use Shoppie\Product;

class ProductObserver
{
    /**
     * Handle the product "created" event.
     *
     * @param  \Shoppie\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        //
    }

    /**
     * Handle the product "updated" event.
     *
     * @param  \Shoppie\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        //
    }

    /**
     * Handle the product "deleted" event.
     *
     * @param  \Shoppie\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        //
    }

    /**
     * Handle the product "restored" event.
     *
     * @param  \Shoppie\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        //
    }

    /**
     * Handle the product "force deleted" event.
     *
     * @param  \Shoppie\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }
}
