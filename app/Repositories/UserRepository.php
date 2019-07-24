<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2018-09-12
 * Time: 8:56 PM
 */

namespace Ddondola\Repositories;


use Ddondola\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    /**
     * Get user by id
     *
     * @param $id
     * @return User
     */
    public function id($id) {
        return User::find($id);
    }

    /**
     * Get user from code
     *
     * @param $code
     * @return User
     */
    public function code($code) {
        return User::where('code', "=", $code)->first();
    }

    /**
     * Create new user
     *
     * @param $data
     * @return User
     */
    public function create($data) {
        return User::create($data)->createCart();
    }

    /**
     * Follow a user
     *
     * @param User $follower
     * @param User $followable
     * @return bool
     */
    public function follow(User $follower, User $followable) {
        if (!$follower->isFollowing($followable)) {
            try {
                $follower->follow($followable);
                return true;
            } catch (\Exception $e) {}
        }

        return false;
    }

    /**
     * Un follow a user
     *
     * @param User $follower
     * @param User $followable
     * @return bool
     */
    public function unFollow(User $follower, User $followable) {
        if ($follower->isFollowing($followable)) {
            $follower->unfollow($followable);
            return false;
        }

        return false;
    }

    public function builder() {
        return User::select();
    }
}