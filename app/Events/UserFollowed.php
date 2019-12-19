<?php

namespace Ddondola\Events;

use Ddondola\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserFollowed implements ShouldBroadcast, ShouldQueue
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var User
     */
    protected $follower;

    /**
     * @var User
     */
    protected $followable;

    /**
     * Create a new event instance.
     *
     * @param User $follower
     * @param User $followable
     */
    public function __construct(User $follower, User $followable)
    {
        $this->follower = $follower;
        $this->followable = $followable;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return [
            $this->channel($this->follower),
            $this->channel($this->followable)
        ];
    }

    /**
     * @param User $user
     * @return Channel
     */
    private function channel(User $user) {
        return new Channel('user.' . $user->code . '.followers');
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'user.followed';
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'follower' => $this->follower->toArray(),
            'followable' => $this->followable->toArray()
        ];
    }
}
