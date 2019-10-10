<?php

namespace Messenger\Http\GraphQL\Queries;

use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Database\Eloquent\Builder;
use Messenger\Facades\Messenger;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

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
            $builder->whereHas('initiator', function ($q) use ($value) {
                $q->where('name', 'like', $value);
            })->orWhereHas('participant', function ($q) use ($value) {
                $q->where('name', 'like', $value);
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
            $builder = $builder->where('name', 'like', '%' . collect($args)->get('search') . '%');
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
