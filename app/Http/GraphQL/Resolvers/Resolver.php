<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2018-09-21
 * Time: 11:03 AM
 */

namespace Ddondola\Http\GraphQL\Resolvers;


use Illuminate\Database\Eloquent\Relations\Relation;

abstract class Resolver
{
    /**
     * @param Relation $relation
     * @param array $args
     * @param string $orderBy
     * @param string $direction
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    protected function withArgs(Relation $relation, array $args, $orderBy = 'created_at', $direction = 'asc')
    {
        $args = collect($args);
        return $relation->skip($args->get('offset', 0))->take($args->get('limit', 10))
            ->orderBy($orderBy, $direction)->get();
    }
}