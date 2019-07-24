<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 26/04/2019
 * Time: 21:18
 */

namespace Messenger;


use Ddondola\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Messenger\Repositories\ConversationRepository;
use Messenger\Repositories\MessageRepository;
use Shoppie\Repository\ShopRepository;

class Messenger
{
    /**
     * @var ConversationRepository
     */
    protected $conversations;

    /**
     * @var MessageRepository
     */
    protected $messages;

    /**
     * Messenger constructor.
     * @param ConversationRepository $conversations
     * @param MessageRepository $messages
     */
    public function __construct(ConversationRepository $conversations, MessageRepository $messages)
    {
        $this->conversations = $conversations;
        $this->messages = $messages;
    }

    /**
     * @param null $participant
     * @return Model
     */
    public function resolveParticipant($participant) {
        $converser = app(UserRepository::class)->code($participant);
        if (!$converser)
            $converser = app(ShopRepository::class)->code($participant);

        return $converser;
    }

    /**
     * @param Model $initiator
     * @param Model $participant
     * @return bool
     */
    public function haveConversation(Model $initiator, Model $participant) {
        return $this->conversations->exists($initiator, $participant);
    }

    /**
     * @param Model $initiator
     * @param Model $participant
     * @return Conversation
     */
    public function resolveConversation(Model $initiator, Model $participant) {
        return $this->conversations->resolve($initiator, $participant);
    }

    /**
     * @param Model $sender
     * @param Model $receiver
     * @param null $message
     * @return Model|Message
     */
    public function message(Model $sender, Model $receiver, $message = null) {
        return $this->messages->create($this->resolveConversation($sender, $receiver), $sender, $message);
    }

    /**
     * Do model route binding
     */
    public static function bindExplicitly() {
        Route::model('conversation', Conversation::class);
    }
}