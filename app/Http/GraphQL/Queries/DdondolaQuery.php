<?php

namespace Ddondola\Http\GraphQL\Queries;

use Ddondola\Repositories\UserRepository;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class DdondolaQuery
{
    /**
     * Return a value for the field.
     *
     * @param null $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param array $args The arguments that were passed into the field.
     * @param GraphQLContext|null $context Arbitrary data that is shared between all fields of a single query.
     * @param ResolveInfo $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     *
     * @return mixed
     */
    public function searchUsers($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $value = "%" . collect($args)->get("name") . "%";

        return app(UserRepository::class)->builder()
            ->where("first_name", "like", $value)
            ->orWhere("last_name", "like", $value)
            ->orWhere("email", "like", $value)
            ->where("active", "=", 1)->get();
    }

    /**
     * Return a value for the field.
     *
     * @param null $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param array $args The arguments that were passed into the field.
     * @param GraphQLContext|null $context Arbitrary data that is shared between all fields of a single query.
     * @param ResolveInfo $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     *
     * @return mixed
     */
    public function paginatedUsers($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $builder = app(UserRepository::class)->builder();
        if (collect($args)->has('search')) {
            $value = "%" . collect($args)->get("search") . "%";
            $builder = $builder->where("first_name", "like", $value)
                ->orWhere("last_name", "like", $value)
                ->orWhere("email", "like", $value);
        }

        return $builder->orderBy("first_name", "asc");
    }

    /**
     * Return a value for the field.
     *
     * @param null $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param array $args The arguments that were passed into the field.
     * @param GraphQLContext|null $context Arbitrary data that is shared between all fields of a single query.
     * @param ResolveInfo $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     *
     * @return mixed
     */
    public function users($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $builder = $rootValue->users();
        if (collect($args)->has('search')) {
            $value = "%" . collect($args)->get("search") . "%";
            $builder = $builder->where("first_name", "like", $value)
                ->orWhere("last_name", "like", $value)
                ->orWhere("email", "like", $value);
        }

        return $builder->orderBy("first_name", "asc");
    }
}
