<?php

namespace Bank\Http\GraphQL\Mutations;

use Bank\Bank;
use Bank\Repositories\WithdrawRequestRepository;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Shoppie\Repository\ShopRepository;

class BankMutator
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
    public function withdrawRequest($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        // todo check password

        $account = null;
        if (collect($args)->has('accountHolder')) {
            $holder = collect($args)->get('accountHolder');
            if ($holder == 'admin') {
                $holder = $holder . "Account";
                $account = app(Bank::class)->adminAccount();
            }

            if (app(ShopRepository::class)->code($holder)) {
                $account = app(ShopRepository::class)->code($holder)->account;
            }
        }

        if (!$account) {
            $account = $context->user()->account;
        }

        // todo verify sufficient balance

        return app(WithdrawRequestRepository::class)->create($account, collect($args)->get('withdraw'));
    }
}
