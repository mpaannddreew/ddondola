<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2019-03-20
 * Time: 12:48 PM
 */

namespace Activity\Traits;


use Activity\Facades\ActivityManager;
use Activity\Repositories\ReviewRepository;
use Activity\Review;
use Illuminate\Database\Eloquent\Model;

trait Reviewable
{
    public function reviews() {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function averageRating() {
        $average = sprintf("%.1f", $this->reviews->average(function(Review $review) {
            return $review->rating;
        }));

        return $average ? $average . "": "0.0";
    }

    public function reviewCount() {
        return $this->reviews()->count();
    }

    public function addReview(Model $reviewer, array $review) {
        return app(ReviewRepository::class)->create($reviewer, $this, $review);
    }

    public function getReviewCountAttribute()
    {
        return $this->reviewCount();
    }

    public function getAverageRatingAttribute()
    {
        return $this->averageRating();
    }
}