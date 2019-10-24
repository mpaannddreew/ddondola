<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2019-03-20
 * Time: 12:46 PM
 */

namespace Activity\Traits;


use Activity\Review;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait Reviewer
{
    /**
     * @return HasMany
     */
    public function reviews() {
        return $this->hasMany(Review::class, 'reviewer_id');
    }

    /**
     * @return array
     */
    public function reviewIds() {
        return $this->reviews()->pluck('id')->all();
    }

    /**
     * @return array
     */
    protected abstract function communityReviewIds();

    /**
     * @return Builder
     */
    public function communityActivity() {
        return Review::query()->whereIn('id', $this->communityReviewIds()->merge($this->reviewIds()));
    }

    /**
     * @param Model $reviewable
     * @return array
     */
    public function hasReviewed(Model $reviewable) {
        return [
            'isReviewed' => $reviewable->reviews->reject(function (Review $review) {
                    return !$review->reviewer->is($this);
                })->count() > 0,
            'review' => $reviewable->reviews->first(function (Review $review) {
                return $review->reviewer->is($this);
            })
        ];
    }
}