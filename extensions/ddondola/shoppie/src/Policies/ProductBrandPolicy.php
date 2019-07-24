<?php

namespace Shoppie\Policies;

use Illuminate\Database\Eloquent\Model as User;
use Shoppie\ProductBrand;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductBrandPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the product brand.
     *
     * @param  User  $user
     * @param  \Shoppie\ProductBrand  $productBrand
     * @return mixed
     */
    public function view(User $user, ProductBrand $productBrand)
    {
        //
    }

    /**
     * Determine whether the user can create product brands.
     *
     * @param  User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the product brand.
     *
     * @param  User  $user
     * @param  \Shoppie\ProductBrand  $productBrand
     * @return mixed
     */
    public function update(User $user, ProductBrand $productBrand)
    {
        return $user->manages($productBrand->shop);
    }

    /**
     * Determine whether the user can delete the product brand.
     *
     * @param  User  $user
     * @param  \Shoppie\ProductBrand  $productBrand
     * @return mixed
     */
    public function delete(User $user, ProductBrand $productBrand)
    {
        //
    }

    /**
     * Determine whether the user can restore the product brand.
     *
     * @param  User  $user
     * @param  \Shoppie\ProductBrand  $productBrand
     * @return mixed
     */
    public function restore(User $user, ProductBrand $productBrand)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the product brand.
     *
     * @param  User  $user
     * @param  \Shoppie\ProductBrand  $productBrand
     * @return mixed
     */
    public function forceDelete(User $user, ProductBrand $productBrand)
    {
        //
    }
}
