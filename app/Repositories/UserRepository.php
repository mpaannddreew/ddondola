<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2018-09-12
 * Time: 8:56 PM
 */

namespace Ddondola\Repositories;


use Ddondola\Country;
use Ddondola\User;

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
     * @param Country $country
     * @param array $attributes
     * @return User
     */
    public function create(Country $country, array $attributes) {
        return User::create(array_merge($attributes, ['country_id' => $country->getKey()]));
    }

    /**
     * @param User $user
     * @param array $attributes
     */
    public function update(User $user, array $attributes) {
        $user->update($attributes);
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
        return User::query();
    }
}