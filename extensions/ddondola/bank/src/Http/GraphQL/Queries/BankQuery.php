<?php

namespace Bank\Http\GraphQL\Queries;

use Bank\Bank;
use Ddondola\Repositories\UserRepository;
use GraphQL\Type\Definition\ResolveInfo;
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
    public function account($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        if (collect($args)->has('accountHolder')) {
            $holder = collect($args)->get('accountHolder');
            if ($holder == 'admin') {
                return app(Bank::class)->adminAccount();
            }

            if (app(ShopRepository::class)->code($holder)) {
                return app(ShopRepository::class)->code($holder)->account;
            } else if(app(UserRepository::class)->code($holder)) {
                return app(UserRepository::class)->code($holder)->account;
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
    public function escrows($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        // $rootValue->incomingEscrows()->orderBy('created_at', 'desc');
        // return $rootValue->outgoingEscrows()->orderBy('created_at', 'desc');

        return $rootValue->escrows()->orderBy('created_at', 'desc');
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
        $builder = $rootValue->transactions();
        if (collect($args)->has('type')) {
            $builder = $builder->where(collect($args)->get('type'), 1);
        }

        return $builder->orderBy('created_at', 'desc');
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
    public function withdrawRequests($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return $rootValue->withdrawRequests()->orderBy('created_at', 'desc');
    }
}
