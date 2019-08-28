<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2019-03-20
 * Time: 1:05 PM
 */

namespace Activity\Repositories;


use Activity\Review;
use Illuminate\Database\Eloquent\Model;

class ReviewRepository
{
    /**
     * @param $id
     * @return Review
     */
    public function id($id) {
        return Review::find($id);
    }

    /**
     * @param Model $reviewer
     * @param Model $reviewable
     * @param array $attributes
     * @return Review
     */
    public function create(Model $reviewable, Model $reviewer, array $attributes) {
        return $reviewable->reviews()->create(array_merge(['reviewer_id' => $reviewer->getKey()], $attributes));
    }

    /**
     * @param Review $review
     * @param array $attributes
     * @return Review
     */
    public function update(Review $review, array $attributes) {
        $review->update($attributes);

        return $review;
    }
}