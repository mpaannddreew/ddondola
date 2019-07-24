<?php

namespace Shoppie\Policies;

use Illuminate\Database\Eloquent\Model as User;
use Shoppie\ProductCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the product category.
     *
     * @param  User  $user
     * @param  \Shoppie\ProductCategory  $productCategory
     * @return mixed
     */
    public function view(User $user, ProductCategory $productCategory)
    {
        //
    }

    /**
     * Determine whether the user can create product categories.
     *
     * @param  User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the product category.
     *
     * @param  User  $user
     * @param  \Shoppie\ProductCategory  $productCategory
     * @return mixed
     */
    public function update(User $user, ProductCategory $productCategory)
    {
        return $user->manages($productCategory->shop);
    }

    /**
     * Determine whether the user can delete the product category.
     *
     * @param  User  $user
     * @param  \Shoppie\ProductCategory  $productCategory
     * @return mixed
     */
    public function delete(User $user, ProductCategory $productCategory)
    {
        //
    }

    /**
     * Determine whether the user can restore the product category.
     *
     * @param  User  $user
     * @param  \Shoppie\ProductCategory  $productCategory
     * @return mixed
     */
    public function restore(User $user, ProductCategory $productCategory)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the product category.
     *
     * @param  User  $user
     * @param  \Shoppie\ProductCategory  $productCategory
     * @return mixed
     */
    public function forceDelete(User $user, ProductCategory $productCategory)
    {
        //
    }
}
