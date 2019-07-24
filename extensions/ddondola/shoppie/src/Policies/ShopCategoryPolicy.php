<?php

namespace Shoppie\Policies;

use Illuminate\Database\Eloquent\Model as User;
use Shoppie\ShopCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShopCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the shop.
     *
     * @param  User  $user
     * @param  \Shoppie\ShopCategory $category
     * @return mixed
     */
    public function view(User $user, ShopCategory $category)
    {
        //
    }

    /**
     * Determine whether the user can create shops.
     *
     * @param  User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the shop.
     *
     * @param  User  $user
     * @param  \Shoppie\ShopCategory $category
     * @return mixed
     */
    public function update(User $user, ShopCategory $category)
    {

    }

    /**
     * Determine whether the user can delete the shop.
     *
     * @param  User  $user
     * @param  \Shoppie\ShopCategory $category
     * @return mixed
     */
    public function delete(User $user, ShopCategory $category)
    {
        //
    }

    /**
     * Determine whether the user can restore the shop.
     *
     * @param  User  $user
     * @param  \Shoppie\ShopCategory $category
     * @return mixed
     */
    public function restore(User $user, ShopCategory $category)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the shop.
     *
     * @param  User  $user
     * @param  \Shoppie\ShopCategory $category
     * @return mixed
     */
    public function forceDelete(User $user, ShopCategory $category)
    {
        //
    }
}
