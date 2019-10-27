<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 06/05/2019
 * Time: 12:53
 */

namespace Messenger\Events;


use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Str;
use Messenger\Message;

class NewMessage implements ShouldBroadcast, ShouldQueue
{
    /**
     * @var Message
     */
    protected $message;

    /**
     * NewMessage constructor.
     * @param Message $message
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|\Illuminate\Broadcasting\Channel[]
     */
    public function broadcastOn()
    {
        return new PrivateChannel('conversation.' . $this->message->conversation->getKey());
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'new.message';
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'id' => $this->message->getKey(),
            'message' => $this->message->message,
            'sender' => $this->sender(),
            'created_at' => $this->message->created_at->toAtomString()
        ];
    }

    /**
     * Determine sender's details
     *
     * @return array
     */
    private function sender()
    {
        return [
            'id' => $this->message->sender->getKey(),
            'name' => $this->senderName(),
            'type' => $this->message->sender->type(),
            'code' => $this->message->sender->code,
            'avatar' => $this->message->sender->avatar(),
        ];
    }

    /**
     * Determine sender's name
     *
     * @return string
     */
    private function senderName()
    {
        if (Str::lower($this->message->sender->type()) == 'user') {
            return $this->message->sender->name();
        }

        return $this->message->sender->name;
    }
}