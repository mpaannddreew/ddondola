<?php

namespace Shoppie\Policies;

use Illuminate\Database\Eloquent\Model as User;
use Shoppie\ProductOffer;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductOfferPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the product offer.
     *
     * @param  User  $user
     * @param  \Shoppie\ProductOffer  $productOffer
     * @return mixed
     */
    public function view(User $user, ProductOffer $productOffer)
    {
        //
    }

    /**
     * Determine whether the user can create product offers.
     *
     * @param  User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the product offer.
     *
     * @param  User  $user
     * @param  \Shoppie\ProductOffer  $productOffer
     * @return mixed
     */
    public function update(User $user, ProductOffer $productOffer)
    {
        return $user->manages($productOffer->product->shop);
    }

    /**
     * Determine whether the user can delete the product offer.
     *
     * @param  User  $user
     * @param  \Shoppie\ProductOffer  $productOffer
     * @return mixed
     */
    public function delete(User $user, ProductOffer $productOffer)
    {
        //
    }

    /**
     * Determine whether the user can restore the product offer.
     *
     * @param  User  $user
     * @param  \Shoppie\ProductOffer  $productOffer
     * @return mixed
     */
    public function restore(User $user, ProductOffer $productOffer)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the product offer.
     *
     * @param  User  $user
     * @param  \Shoppie\ProductOffer  $productOffer
     * @return mixed
     */
    public function forceDelete(User $user, ProductOffer $productOffer)
    {
        //
    }
}
