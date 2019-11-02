<?php

namespace Shoppie\Policies;

use Illuminate\Database\Eloquent\Model as User;
use Shoppie\Shop;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShopPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->admin() || $user->is_seller) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the shop.
     *
     * @param  User  $user
     * @param  \Shoppie\Shop  $shop
     * @return mixed
     */
    public function view(User $user, Shop $shop)
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
     * @param  \Shoppie\Shop  $shop
     * @return mixed
     */
    public function update(User $user, Shop $shop)
    {
        return $user->manages($shop);
    }

    /**
     * Determine whether the user can delete the shop.
     *
     * @param  User  $user
     * @param  \Shoppie\Shop  $shop
     * @return mixed
     */
    public function delete(User $user, Shop $shop)
    {
        //
    }

    /**
     * Determine whether the user can restore the shop.
     *
     * @param  User  $user
     * @param  \Shoppie\Shop  $shop
     * @return mixed
     */
    public function restore(User $user, Shop $shop)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the shop.
     *
     * @param  User  $user
     * @param  \Shoppie\Shop  $shop
     * @return mixed
     */
    public function forceDelete(User $user, Shop $shop)
    {
        //
    }
}
