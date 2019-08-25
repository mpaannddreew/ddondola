<?php

namespace Ddondola\Http\GraphQL\Queries;

use Ddondola\Repositories\UserRepository;
use Ddondola\User;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class AccountQuery
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
    public function user($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        return app(UserRepository::class)->code($args["user"]);
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
    public function iFollowUser($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        return $context->user()->isFollowing(app(UserRepository::class)->id($args["id"]));
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
        $builder = app(UserRepository::class)->builder()->whereNotIn('id', [$context->user()->id]);
        if ($context->user()) {
            $myCountry = collect($args)->get('myCountry', true);
            if ($myCountry) {
                $builder = $builder->whereHas('country', function ($q) use ($context) {
                    $q->where('id', $context->user()->country->id);
                });
            }
        }
        return $this->orderBy($this->status($builder), "first_name", "asc");
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
    public function paginatedFollowers($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        return $this->orderBy($this->status($rootValue->followers()), "first_name", "asc");
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
    public function paginatedFollowing($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        return $this->orderBy($this->status($rootValue->followings()), "first_name", "asc");
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
    public function notifications($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        return $rootValue->notifications();
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
    public function searchUsers($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $value = "%" . collect($args)->get("name") . "%";
        $users = $this->status(User::select());
        if ($context->user()) {
            $users = $users->whereHas('country', function ($q) use ($context) {
                $q->where('id', $context->user()->country->id);
            });
        }
        return $users->where("first_name", "like", $value)
            ->orWhere("last_name", "like", $value)
            ->where("active", "=", 1)->get();
    }

    protected function orderBy($builder, $column="created_at", $order="desc") {
        return $builder->orderBy($column, $order);
    }

    protected function status($builder, $status=1) {
        if($status) {
            $builder = $builder->where('active', '=', $status);
        }
        return $builder;
    }
}
