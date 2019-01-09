<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2018-09-19
 * Time: 8:21 PM
 */

namespace Ddondola\Http\GraphQL\Queries;


use Ddondola\Repositories\UserRepository;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Schema\Context;

class Users extends Query
{
    /**
     * @var UserRepository
     */
    protected $users;

    public function __construct()
    {
        $this->users = app(UserRepository::class);
    }

    /**
     * Create a users collection
     *
     * @param $obj
     * @param $args
     * @param Context $context
     * @param ResolveInfo $info
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function resolve($obj, $args, Context $context, ResolveInfo $info)
    {
        $args = collect($args);
        return $this->users->all($args->get('offset', 0), $args->get('limit', 10), $args->get('active'));
    }
}