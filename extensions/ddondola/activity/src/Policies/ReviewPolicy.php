<?php

namespace Activity\Policies;

use Activity\Review;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model as User;

class ReviewPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the review.
     *
     * @param  User  $user
     * @param  \Activity\Review  $review
     * @return mixed
     */
    public function view(User $user, Review $review)
    {
        //
    }

    /**
     * Determine whether the user can create reviews.
     *
     * @param  User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the review.
     *
     * @param  User  $user
     * @param  \Activity\Review  $review
     * @return mixed
     */
    public function update(User $user, Review $review)
    {
        return $user->is($review->reviewer);
    }

    /**
     * Determine whether the user can delete the review.
     *
     * @param  User  $user
     * @param  \Activity\Review  $review
     * @return mixed
     */
    public function delete(User $user, Review $review)
    {
        //
    }

    /**
     * Determine whether the user can restore the review.
     *
     * @param  User  $user
     * @param  \Activity\Review  $review
     * @return mixed
     */
    public function restore(User $user, Review $review)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the review.
     *
     * @param  User  $user
     * @param  \Activity\Review  $review
     * @return mixed
     */
    public function forceDelete(User $user, Review $review)
    {
        //
    }
}
