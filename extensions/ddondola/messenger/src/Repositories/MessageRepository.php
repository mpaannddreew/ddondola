<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 26/04/2019
 * Time: 21:55
 */

namespace Messenger\Repositories;


use Illuminate\Database\Eloquent\Model;
use Messenger\Conversation;
use Messenger\Message;

class MessageRepository
{
    /**
     * Get message by id
     *
     * @param $id
     * @return Message
     */
    public function id($id) {
        return Message::find($id);
    }

    /**
     * Create message
     *
     * @param Conversation $conversation
     * @param Model $sender
     * @param null $message
     * @return Model|Message
     */
    public function create(Conversation $conversation, Model $sender, $message) {
        return $conversation->messages()->create([
            'sender_id' => $sender->getKey(),
            'sender_type' => get_class($sender),
            'message' => $message
        ]);
    }

    public function update(Message $message, array $attributes) {
        $message->update($attributes);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function builder() {
        return Message::query();
    }
}