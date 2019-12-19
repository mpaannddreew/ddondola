<?php

namespace Activity\Broadcasting;

use Ddondola\User;

class ReviewChannel
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
     * @param  \Ddondola\User $user
     * @param $type
     * @param $reviewable
     * @return void
     */
    public function join(User $user, $type, $reviewable)
    {

    }
}
