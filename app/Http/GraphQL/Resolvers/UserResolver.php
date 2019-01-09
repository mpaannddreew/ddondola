<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2018-09-20
 * Time: 8:56 AM
 */

namespace Ddondola\Http\GraphQL\Resolvers;


use Ddondola\User;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Schema\Context;
use Shoppie\Product;
use Shoppie\Shop;

class UserResolver extends Resolver
{
    /**
     * User's shops
     *
     * @param User $user
     * @param $args
     * @param Context $context
     * @param ResolveInfo $info
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function shops(User $user, $args, Context $context, ResolveInfo $info) {
        return $this->withArgs($user->shops(), $args, 'created_at', 'desc');
    }

    /**
     * User's followers
     *
     * @param User $user
     * @param $args
     * @param Context $context
     * @param ResolveInfo $info
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function followers(User $user, $args, Context $context, ResolveInfo $info) {
        return $this->withArgs($user->followers(), $args, 'first_name');
    }

    /**
     * User's user following
     *
     * @param User $user
     * @param $args
     * @param Context $context
     * @param ResolveInfo $info
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function userFollowing(User $user, $args, Context $context, ResolveInfo $info) {
        return $this->withArgs($user->followings(User::class), $args, 'first_name');
    }

    /**
     * User's shop following
     *
     * @param User $user
     * @param $args
     * @param Context $context
     * @param ResolveInfo $info
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function shopFollowing(User $user, $args, Context $context, ResolveInfo $info) {
        return $this->withArgs($user->followings(Shop::class), $args, 'name');
    }

    /**
     * User's favourite products
     *
     * @param User $user
     * @param $args
     * @param Context $context
     * @param ResolveInfo $info
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function favouriteProducts(User $user, $args, Context $context, ResolveInfo $info) {
        return $this->withArgs($user->favorites(Product::class), $args, 'name');
    }
}