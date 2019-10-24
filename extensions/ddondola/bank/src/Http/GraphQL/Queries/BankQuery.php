<?php

namespace Bank\Http\GraphQL\Queries;

use Ddondola\Repositories\UserRepository;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Str;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Shoppie\Repository\ShopRepository;

class BankQuery
{
    /**
     * Return a value for the field.
     *
     * @param  null  $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param  mixed[]  $args The arguments that were passed into the field.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Arbitrary data that is shared between all fields of a single query.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     * @return mixed
     */
    public function outgoingEscrows($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return $rootValue->outgoingEscrows();
    }

    /**
     * Return a value for the field.
     *
     * @param  null  $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param  mixed[]  $args The arguments that were passed into the field.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Arbitrary data that is shared between all fields of a single query.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     * @return mixed
     */
    public function account($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        if (collect($args)->has('accountHolder')) {
            if (app(ShopRepository::class)->code(collect($args)->get('accountHolder'))) {
                return app(ShopRepository::class)->code(collect($args)->get('accountHolder'))->account;
            } else if(app(UserRepository::class)->code(collect($args)->get('accountHolder'))) {
                return app(UserRepository::class)->code(collect($args)->get('accountHolder'))->account;
            }
        }

        return $context->user()->account;
    }

    /**
     * Return a value for the field.
     *
     * @param  null  $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param  mixed[]  $args The arguments that were passed into the field.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Arbitrary data that is shared between all fields of a single query.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     * @return mixed
     */
    public function incomingEscrows($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return $rootValue->incomingEscrows();
    }

    /**
     * Return a value for the field.
     *
     * @param  null  $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param  mixed[]  $args The arguments that were passed into the field.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Arbitrary data that is shared between all fields of a single query.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     * @return mixed
     */
    public function payments($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return $rootValue->payments();
    }

    /**
     * Return a value for the field.
     *
     * @param  null  $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param  mixed[]  $args The arguments that were passed into the field.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Arbitrary data that is shared between all fields of a single query.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     * @return mixed
     */
    public function transactions($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return $rootValue->{Str::plural(collect($args)->get('type', 'transaction'))}();
    }
}
