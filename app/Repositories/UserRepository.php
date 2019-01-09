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
    const DEFAULT_USER_ABOUT = [
        'about' => [
            'description' => null,
            'location' => null,
            'phone_number' => null
        ]
    ];

    const DEFAULT_SHOP_SETTINGS = [
        'settings' => [
            'enable_following' => true,
            'enable_notifications' => true,
            'enable_messaging' => true
        ]
    ];

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
        return User::where('code', $code)->first();
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
     * Get a collection of users
     *
     * @param int $offset
     * @param int $limit
     * @param null $active
     * @return Collection
     */
    public function all($offset = 0, $limit = 10, $active = null) {
        return $active ? User::where('active', '=', $active)->skip($offset)->take($limit)->get()
            : User::skip($offset)->take($limit)->get();
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
            return true;
        }

        return false;
    }
}