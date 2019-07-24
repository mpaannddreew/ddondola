<?php

namespace Shoppie\Policies;

use Illuminate\Database\Eloquent\Model as User;
use Shoppie\ProductSubCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductSubCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the product sub category.
     *
     * @param  User  $user
     * @param  \Shoppie\ProductSubCategory  $productSubCategory
     * @return mixed
     */
    public function view(User $user, ProductSubCategory $productSubCategory)
    {
        //
    }

    /**
     * Determine whether the user can create product sub categories.
     *
     * @param  User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the product sub category.
     *
     * @param  User  $user
     * @param  \Shoppie\ProductSubCategory  $productSubCategory
     * @return mixed
     */
    public function update(User $user, ProductSubCategory $productSubCategory)
    {
        return $user->manages($productSubCategory->category->shop);
    }

    /**
     * Determine whether the user can delete the product sub category.
     *
     * @param  User  $user
     * @param  \Shoppie\ProductSubCategory  $productSubCategory
     * @return mixed
     */
    public function delete(User $user, ProductSubCategory $productSubCategory)
    {
        //
    }

    /**
     * Determine whether the user can restore the product sub category.
     *
     * @param  User  $user
     * @param  \Shoppie\ProductSubCategory  $productSubCategory
     * @return mixed
     */
    public function restore(User $user, ProductSubCategory $productSubCategory)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the product sub category.
     *
     * @param  User  $user
     * @param  \Shoppie\ProductSubCategory  $productSubCategory
     * @return mixed
     */
    public function forceDelete(User $user, ProductSubCategory $productSubCategory)
    {
        //
    }
}
