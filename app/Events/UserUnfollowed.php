<?php

namespace Ddondola\Events;


class UserUnfollowed extends UserFollowed
{
    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'user.unfollowed';
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'follower' => $this->follower->only(['id', 'code']),
            'followable' => $this->followable->only(['id', 'code'])
        ];
    }
}
