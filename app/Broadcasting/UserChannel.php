<?php

namespace Ddondola\Broadcasting;

use Ddondola\User;

class UserChannel
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
     * @param User $current
     * @param  \Ddondola\User $user
     * @return bool
     */
    public function join(User $current, User $user)
    {
        return $current->is($user);
    }
}
