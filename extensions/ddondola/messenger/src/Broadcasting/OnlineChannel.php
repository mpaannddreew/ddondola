<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 15/12/2019
 * Time: 16:36
 */

namespace Messenger\Broadcasting;


use Ddondola\User;
use Illuminate\Support\Str;
use Messenger\Conversation;

class OnlineChannel
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
        $participant = $conversation->participant;
        $initiator = $conversation->initiator;

        if (Str::lower($participant->type()) === 'shop') {
            if ($user->manages($participant)) {
                if (!$user->is($initiator)) {
                    return array_merge($participant->only(['id', 'code']), ['type' => $participant->type(), 'admin' => true]);
                }
            }
        }

        if (Str::lower($initiator->type()) === 'shop') {
            if ($user->manages($initiator)) {
                if (!$user->is($participant)) {
                    return array_merge($initiator->only(['id', 'code']), ['type' => $initiator->type(), 'admin' => true]);
                }
            }
        }

        if ($user->is($participant)) {
            return array_merge($participant->only(['id', 'code']), ['type' => $participant->type()]);
        }

        if ($user->is($initiator)) {
            return array_merge($initiator->only(['id', 'code']), ['type' => $initiator->type()]);
        }

        return false;
    }
}