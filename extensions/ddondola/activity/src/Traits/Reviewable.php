<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2019-03-20
 * Time: 12:48 PM
 */

namespace Activity\Traits;


use Activity\Review;

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

    public function getReviewCountAttribute()
    {
        return $this->reviewCount();
    }

    public function getAverageRatingAttribute()
    {
        return $this->averageRating();
    }

    protected function groupByRating() {
        return $this->reviews->groupBy(function (Review $review) {
            return $review->rating;
        });
    }

    protected function oneStarCount() {
        return collect($this->groupByRating()->get('1'))->count();
    }

    public function getOneStarCountAttribute() {
        return $this->oneStarCount();
    }

    protected function twoStarCount() {
        return collect($this->groupByRating()->get('2'))->count();
    }

    public function getTwoStarCountAttribute() {
        return $this->twoStarCount();
    }

    protected function threeStarCount() {
        return collect($this->groupByRating()->get('3'))->count();
    }

    public function getThreeStarCountAttribute() {
        return $this->threeStarCount();
    }

    protected function fourStarCount() {
        return collect($this->groupByRating()->get('4'))->count();
    }

    public function getFourStarCountAttribute() {
        return $this->fourStarCount();
    }

    protected function fiveStarCount() {
        return collect($this->groupByRating()->get('5'))->count();
    }

    public function getFiveStarCountAttribute() {
        return $this->fiveStarCount();
    }
}