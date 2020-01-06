<?php

namespace Activity\Observers;

use Activity\Events\NewReview;
use Activity\Events\ReviewUpdate;
use Activity\Review;
use Activity\Events\UpdateReviews;
use Ddondola\Notifications\UserNotification;
use Illuminate\Support\Facades\Notification;

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
        broadcast(new NewReview($review));
        broadcast(new UpdateReviews($review->reviewable));
        Notification::send($review->reviewer->followers, new UserNotification($review->reviewer, $review->reviewable, 'review'));
    }

    /**
     * Handle the review "updated" event.
     *
     * @param  \Activity\Review  $review
     * @return void
     */
    public function updated(Review $review)
    {
        broadcast(new ReviewUpdate($review));
        broadcast(new UpdateReviews($review->reviewable));
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
