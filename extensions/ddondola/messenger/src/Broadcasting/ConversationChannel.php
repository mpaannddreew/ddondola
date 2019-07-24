<?php

namespace Messenger\Broadcasting;

use Illuminate\Database\Eloquent\Model as User;
use Messenger\Conversation;

class ConversationChannel
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param  User $user
     * @param Conversation $conversation
     * @return boolean
     */
    public function join(User $user, Conversation $conversation)
    {
        if ($user->is($conversation->initiator) || $user->is($conversation->participant))
            return true;

        if (strtolower($conversation->initiator->type()) == 'shop')
            return $user->manages($conversation->initiator);

        if (strtolower($conversation->participant->type()) == 'shop')
            return $user->manages($conversation->participant);

        return false;
    }
}
