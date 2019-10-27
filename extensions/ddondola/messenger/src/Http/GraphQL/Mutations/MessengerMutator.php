<?php

namespace Messenger\Http\GraphQL\Mutations;

use GraphQL\Type\Definition\ResolveInfo;
use Messenger\Facades\Messenger;
use Messenger\Repositories\ConversationRepository;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class MessengerMutator
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
    public function createConversation($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $args = collect($args);
        if($args->has('initiator')) {
            $initiator = Messenger::resolveParticipant($args->get('initiator'));
        } else {
            $initiator = $context->user();
        }

        $participant = Messenger::resolveParticipant($args->get('participant'));

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
    public function readConversation($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        return app(ConversationRepository::class)
            ->id(collect($args)->get('conversation'))
            ->markReadBy(Messenger::resolveConverser(collect($args)->get('converser')));
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
    public function sendMessage($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $args = collect($args);
        if($args->has('initiator')) {
            $sender = Messenger::resolveParticipant($args->get('initiator'));
        } else {
            $sender = $context->user();
        }

        $receiver = Messenger::resolveParticipant($args->get('participant'));

        $message = Messenger::message($sender, $receiver, $args->get('message', null));

        // todo add media files if any exist
        return $message;
    }
}
