<?php

namespace Activity\Http\GraphQL\Mutations;

use Activity\Repositories\ReviewRepository;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Exceptions\AuthorizationException;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Shoppie\Repository\ProductRepository;
use Shoppie\Repository\ShopRepository;

class ActivityMutator
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
    public function addReview($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $id = collect($args["entity"])->get('id');
        if (collect($args["entity"])->get('type') == 'shop' ) {
            return app(ShopRepository::class)->id($id)->review($context->user(), $args["review"]);
        } else {
            return app(ProductRepository::class)->id($id)->review($context->user(), $args["review"]);
        }
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
     * @throws AuthorizationException
     */
    public function editReview($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $review = app(ReviewRepository::class)->id($args["id"]);
        if ($context->user()->can('update', $review)) {
            return app(ReviewRepository::class)->update($review, $args["review"]);
        }

        throw new AuthorizationException;
    }
}
