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
     * @var UserRepository
     */
    protected $users;

    /**
     * @var ShopRepository
     */
    protected $shops;

    /**
     * Messenger constructor.
     * @param ConversationRepository $conversations
     * @param MessageRepository $messages
     * @param UserRepository $users
     * @param ShopRepository $shops
     */
    public function __construct(ConversationRepository $conversations, MessageRepository $messages,
                                UserRepository $users, ShopRepository $shops)
    {
        $this->conversations = $conversations;
        $this->messages = $messages;
        $this->users = $users;
        $this->shops = $shops;
    }

    /**
     * Resolve conversation participant
     *
     * @param $participant
     * @return Model
     */
    public function resolveParticipant($participant) {
        $converser = $this->users->code($participant);
        if (!$converser)
            $converser = $this->shops->code($participant);

        return $converser;
    }

    /**
     * Check if two entities have a conversation together
     *
     * @param Model $initiator
     * @param Model $participant
     * @return bool
     */
    public function haveConversation(Model $initiator, Model $participant) {
        return $this->conversations->exists($initiator, $participant);
    }

    /**
     * Resolve conversation between two entities
     *
     * @param Model $initiator
     * @param Model $participant
     * @return Conversation
     */
    public function resolveConversation(Model $initiator, Model $participant) {
        return $this->conversations->resolve($initiator, $participant);
    }

    /**
     * Create a new message
     *
     * @param Model $sender
     * @param Model $receiver
     * @param null $message
     * @return Model|Message
     */
    public function message(Model $sender, Model $receiver, $message) {
        return $this->messages->create($this->resolveConversation($sender, $receiver), $sender, $message);
    }
}