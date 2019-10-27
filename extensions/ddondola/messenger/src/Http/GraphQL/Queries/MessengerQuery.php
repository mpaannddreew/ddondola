<?php

namespace Messenger\Http\GraphQL\Queries;

use Ddondola\Repositories\UserRepository;
use Ddondola\User;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Messenger\Facades\Messenger;
use Messenger\Repositories\ConversationRepository;
use Messenger\Repositories\MessageRepository;
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
    public function unreadCount($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        return $rootValue->unreadBy(Messenger::resolveConverser(collect($args)->get('converser')));
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
        $builder = app(ConversationRepository::class)->builder()->has('messages');
        if (collect($args)->has('search')) {
            $value = '%' . collect($args)->get('search') . '%';
            $builder->where(function ($query) use ($rootValue, $value) {
                $query->whereIn('id', $rootValue->conversations())
                    ->whereHasMorph('initiator', [User::class], function ($q) use ($value) {
                        $q->where('first_name', 'like', $value);
                    });
            })->orWhere(function ($query) use ($rootValue, $value) {
                $query->whereIn('id', $rootValue->conversations())
                    ->whereHasMorph('initiator', [User::class], function ($q) use ($value) {
                        $q->where('last_name', 'like', $value);
                    });
            })->orWhere(function ($query) use ($rootValue, $value) {
                $query->whereIn('id', $rootValue->conversations())
                    ->whereHasMorph('participant', [User::class], function ($q) use ($value) {
                        $q->where('first_name', 'like', $value);
                    });
            })->orWhere(function ($query) use ($rootValue, $value) {
                $query->whereIn('id', $rootValue->conversations())
                    ->whereHasMorph('participant', [User::class], function ($q) use ($value) {
                        $q->where('last_name', 'like', $value);
                    });
            })->orWhere(function ($query) use ($rootValue, $value) {
                $query->whereIn('id', $rootValue->conversations())
                    ->whereHasMorph('initiator', [Shop::class], function ($q) use ($value) {
                        $q->where('name', 'like', $value);
                    });
            })->orWhere(function ($query) use ($rootValue, $value) {
                $query->whereIn('id', $rootValue->conversations())
                    ->whereHasMorph('participant', [Shop::class], function ($q) use ($value) {
                        $q->where('name', 'like', $value);
                    });
            });
        }else {
            $builder->whereIn('id', $rootValue->conversations());
        }

        $latestMessages = app(MessageRepository::class)->builder()
            ->select('conversation_id', DB::raw('MAX(created_at) as last_message_created_at'))
            ->groupBy('conversation_id');

        return $builder->joinSub($latestMessages, 'latest_messages', function ($join) {
            $join->on('conversations.id', '=', 'latest_messages.conversation_id');
        })->latest('latest_messages.last_message_created_at');
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
        $builder = app(UserRepository::class)->builder();
        if (collect($args)->has('search')) {
            $value = '%' . collect($args)->get('search') . '%';
            $builder->where(function ($query) use ($rootValue, $value) {
                $query->whereIn('id', $rootValue->contacts())
                    ->where('first_name', 'like', $value);
            })->orWhere(function ($query) use ($rootValue, $value) {
                $query->whereIn('id', $rootValue->contacts())
                    ->where('last_name', 'like', $value);
            });
        }else {
            $builder->whereIn('id', $rootValue->contacts());
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
