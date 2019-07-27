<?php

namespace Activity\Http\GraphQL\Queries;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Shoppie\Facades\Shoppie;
use Shoppie\Repository\ProductRepository;
use Shoppie\Repository\ShopRepository;

class ActivityQuery
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
    public function paginatedReviews($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        return $this->orderBy($rootValue->reviews());
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
    public function communityActivity($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        return $this->orderBy($rootValue->communityActivity());
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
    public function isReviewed($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $type = collect($args["entity"])->get('type');
        $id = collect($args["entity"])->get('id');
        if ($type == 'shop' ) {
            return $context->user()->hasReviewed(app(ShopRepository::class)->id($id));
        } else {
            return $context->user()->hasReviewed(app(ProductRepository::class)->id($id));
        }
    }

    protected function orderBy($builder, $column="created_at", $order="desc") {
        return $builder->orderBy($column, $order);
    }
}