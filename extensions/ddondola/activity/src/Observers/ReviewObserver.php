<?php

namespace Activity\Observers;

use Activity\Review;

class ReviewObserver
{
    /**
     * Handle the review "created" event.
     *
     * @param  \Activity\Review  $review
     * @return void
     */
    public function created(Review $review)
    {
        //
    }

    /**
     * Handle the review "updated" event.
     *
     * @param  \Activity\Review  $review
     * @return void
     */
    public function updated(Review $review)
    {
        //
    }

    /**
     * Handle the review "deleted" event.
     *
     * @param  \Activity\Review  $review
     * @return void
     */
    public function deleted(Review $review)
    {
        //
    }

    /**
     * Handle the review "restored" event.
     *
     * @param  \Activity\Review  $review
     * @return void
     */
    public function restored(Review $review)
    {
        //
    }

    /**
     * Handle the review "force deleted" event.
     *
     * @param  \Activity\Review  $review
     * @return void
     */
    public function forceDeleted(Review $review)
    {
        //
    }
}
