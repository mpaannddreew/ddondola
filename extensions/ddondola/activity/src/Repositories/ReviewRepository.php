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
     * @param array $review
     * @return Review
     */
    public function create(Model $reviewer, Model $reviewable, array $review) {
        return $reviewable->reviews()->create(array_merge(['reviewer_id' => $reviewer->id], $review));
    }

    /**
     * @param Review $review
     * @param null $rating
     * @param null $body
     * @return Review
     */
    public function edit(Review $review, $rating = null, $body = null) {
        if ($rating) {
            $review->rating = $rating;
        }

        if ($body) {
            $review->body = $body;
        }

        if ($body || $rating) {
            $review->save();
        }

        return $review;
    }
}