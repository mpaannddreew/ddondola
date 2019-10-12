<?php

namespace Messenger\Http\GraphQL\Queries;

use Ddondola\User;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Database\Eloquent\Builder;
use Messenger\Facades\Messenger;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Shoppie\Shop;

class MessengerQuery
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
    public function messages($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        return $this->orderBy($rootValue->messages());
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
    public function conversations($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $builder = $rootValue->conversations();
        if (collect($args)->has('search')) {
            $value = '%' . collect($args)->get('search') . '%';

            $builder->whereHasMorph('initiator', '*', function ($q, $type) use ($value) {
                if ($type === Shop::class) {
                    $q->where('first_name', 'like', $value)
                        ->orWhere('last_name', 'like', $value)
                        ->orWhere('email', 'like', $value);
                }

                if ($type === User::class) {

                }
            })->orWhereHasMorph('participant', '*', function ($q, $type) use ($value) {
                if ($type === Shop::class) {
                    $q->where('first_name', 'like', $value)
                        ->orWhere('last_name', 'like', $value)
                        ->orWhere('email', 'like', $value);
                }

                if ($type === User::class) {

                }
            });
        }
        return $this->orderBy($builder);
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
    public function conversation($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $args = collect($args);
        if($args->has('initiator')) {
            $initiator = Messenger::resolveParticipant($args->get('initiator'));
        } else {
            $initiator = $context->user();
        }

        $participant = Messenger::resolveParticipant($args->get('participant'));

        if (!Messenger::haveConversation($initiator, $participant)) {
            return null;
        }

        return Messenger::resolveConversation($initiator, $participant);
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
    public function contacts($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $builder = $rootValue->contacts();
        if (collect($args)->has('search')) {
            $value = '%' . collect($args)->get('search') . '%';
            $builder = $builder->where('first_name', 'like', $value)
                ->orWhere('last_name', 'like', $value);
        }
        
        return $this->orderBy($builder, "first_name", "asc");
    }

    /**
     * Order by column
     *
     * @param $builder
     * @param string $column
     * @param string $order
     * @return Builder
     */
    protected function orderBy($builder, $column="created_at", $order="desc") {
        return $builder->orderBy($column, $order);
    }
}
