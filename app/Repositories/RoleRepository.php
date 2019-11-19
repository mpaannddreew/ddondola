<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 19/11/2019
 * Time: 21:46
 */

namespace Ddondola\Repository;


use Ddondola\Role;
use Ddondola\User;

class RoleRepository
{
    public function builder() {
        return Role::query();
    }

    /**
     * @param $id
     * @return Role
     */
    public function id($id) {
        return Role::find($id);
    }

    /**
     * @param $tag
     * @return Role|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
     */
    public function tag($tag) {
        return $this->builder()->where('tag', '=', $tag)->first();
    }

    /**
     * @param array $attribute
     * @return Role
     */
    public function create(array $attribute) {
        return Role::create($attribute);
    }

    /**
     * @param User $user
     * @param Role $role
     * @return bool
     */
    public function hasRole(User $user, Role $role) {
        return $user->roles->contains($role);
    }

    /**
     * @param User $user
     * @param Role $role
     */
    public function assignRole(User $user, Role $role) {
        if (!$this->hasRole($user, $role)) {
            $user->roles()->attach($role);
        }
    }

    /**
     * @param User $user
     * @param Role $role
     */
    public function removeRole(User $user, Role $role) {
        if ($this->hasRole($user, $role)) {
            $user->roles()->detach($role);
        }
    }
}