<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2018-09-20
 * Time: 12:05 PM
 */

namespace Messenger\Traits;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Messenger\Conversation;
use Messenger\Message;
use Messenger\Repositories\ConversationRepository;

trait Converser
{
    /**
     * Sent messages
     *
     * @return MorphMany
     */
    public function messages() {
        return $this->morphMany(Message::class, 'sender');
    }

    /**
     * Initiated conversations
     *
     * @return MorphMany
     */
    public function initiatedConversations() {
        return $this->morphMany(Conversation::class, 'initiator');
    }

    /**
     * Participated in conversations
     *
     * @return MorphMany
     */
    public function participatedInConversations() {
        return $this->morphMany(Conversation::class, 'participant');
    }

    /**
     * @return array
     */
    public function conversations() {
        return $this->initiatedConversations()->pluck('id')->merge($this->participatedInConversations()->pluck('id'))->all();
    }

    abstract public function contacts();

    /**
     * @return int
     */
    public function unreadMessageCount() {
        return app(ConversationRepository::class)->builder()
            ->has('messages')
            ->whereIn('id', $this->conversations())
            ->get()->sum(function (Conversation $conversation) {
                return $conversation->unreadBy($this);
            });
    }
}
