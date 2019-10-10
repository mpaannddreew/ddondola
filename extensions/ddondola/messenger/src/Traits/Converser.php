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
     * Conversation ids
     *
     * @return array
     */
    private function eitherConversations() {
        return ($this->initiatedConversations->pluck('id'))->merge($this->participatedInConversations->pluck('id'));
    }

    /**
     * All conversations builder
     *
     * @return Builder
     */
    public function conversations() {
        return Conversation::whereIn('id', $this->eitherConversations());
    }

    abstract public function contactIds();

    /**
     * Converser contacts
     *
     * @return Builder
     */
    public function contacts() {
        return config('messenger.contact')::whereIn('id', $this->contactIds());
    }
}
