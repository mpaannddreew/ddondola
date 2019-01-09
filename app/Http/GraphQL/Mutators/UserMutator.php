<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2018-09-19
 * Time: 5:09 PM
 */

namespace Ddondola\Http\GraphQL\Mutators;


use Ddondola\Repositories\UserRepository;
use Nuwave\Lighthouse\Schema\Context;

class UserMutator
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
     * Create a new user
     *
     * @param $root
     * @param array $args
     * @param Context $context
     * @return \Ddondola\User
     */
    public function create($root, array $args, Context $context) {
        return $this->users->create(collect($args)->only(['first_name', 'last_name', 'email', 'password'])->all());
    }

    public function update($root, array $args, Context $context) {
        // todo if need arises
    }

    /**
     * follow a user
     *
     * @param $root
     * @param array $args
     * @param Context $context
     * @return bool
     */
    public function follow($root, array $args, Context $context) {
        $followable = $this->users->id($args['userId']);
        if ($followable) {
            return $this->users->follow($context->request->user(), $followable);
        }

        return false;
    }

    /**
     * Un follow a user
     *
     * @param $root
     * @param array $args
     * @param Context $context
     * @return bool
     */
    public function unFollow($root, array $args, Context $context) {
        $followable = $this->users->id($args['userId']);
        if ($followable) {
            return $this->users->unFollow($context->request->user(), $followable);
        }

        return false;
    }
}