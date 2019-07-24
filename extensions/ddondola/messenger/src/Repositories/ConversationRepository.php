<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 26/04/2019
 * Time: 21:35
 */

namespace Messenger\Repositories;


use Illuminate\Database\Eloquent\Model;
use Messenger\Conversation;

class ConversationRepository
{
    /**
     * Get conversation by id
     *
     * @param $id
     * @return Conversation
     */
    public function id($id) {
        return Conversation::find($id);
    }

    /**
     * Create new conversation
     *
     * @param Model $initiator
     * @param Model $participant
     * @return mixed
     */
    public function create(Model $initiator, Model $participant) {
        return $initiator->initiatedConversations()->create([
            'participant_id' => $participant->id,
            'participant_type' => get_class($participant)
        ]);
    }

    /**
     * Get conversation between parties if exists
     *
     * @param Model $initiator
     * @param Model $participant
     * @return Conversation|null
     */
    protected function get(Model $initiator, Model $participant) {
        $conversation = $initiator->initiatedConversations->first(function (Conversation $conversation) use ($participant){
            return $conversation->participant->is($participant);
        });

        if (!$conversation)
            $conversation = $participant->initiatedConversations->first(function (Conversation $conversation) use ($initiator){
                return $conversation->participant->is($initiator);
            });

        return $conversation;
    }

    /**
     * Conversation exists
     *
     * @param Model $initiator
     * @param Model $participant
     * @return bool
     */
    public function exists(Model $initiator, Model $participant) {
        return !is_null($this->get($initiator, $participant));
    }

    /**
     * Resolve/create conversation between parties
     *
     * @param Model $initiator
     * @param Model $participant
     * @return Conversation
     */
    public function resolve(Model $initiator, Model $participant) {
        $conversation = $this->get($initiator, $participant);

        if (!$conversation)
            $conversation = $this->create($initiator, $participant);

        return $conversation;
    }
}