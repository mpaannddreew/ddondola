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
use Messenger\Message;

class NewMessage implements ShouldBroadcast, ShouldQueue
{
    protected $message;

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
        return new PrivateChannel('conversation.' . $this->message->conversation->id);
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
            'id' => $this->message->id,
            'message' => $this->message->message,
            'sender' => $this->sender(),
            'created_at' => $this->message->created_at->toAtomString()
        ];
    }

    private function sender()
    {
        $sender = [
            'id' => $this->message->sender->id,
            'name' => $this->senderName(),
            'type' => $this->message->sender->type(),
            'code' => $this->message->sender->code,
            'avatar' => $this->message->sender->avatar(),
        ];

        return $sender;
    }

    private function senderName()
    {
        if (strtolower($this->message->sender->type()) == 'user') {
            return $this->message->sender->name();
        }

        return $this->message->sender->name;
    }
}