<?php

namespace Shoppie\Policies;

use Ddondola\Repository\RoleRepository;
use Ddondola\User;
use Shoppie\Shop;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShopPolicy
{
    use HandlesAuthorization;

    protected $roles;

    public function __construct(RoleRepository $roles)
    {
        $this->roles = $roles;
    }

    public function before(User $user, $ability)
    {
        if ($this->roles->hasRole($user, $this->roles->tag('vendor'))) {
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
