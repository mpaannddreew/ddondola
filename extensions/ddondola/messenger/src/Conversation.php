<?php

namespace Messenger;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Messenger\Repositories\MessageRepository;

class Conversation extends Model
{
    protected $fillable = ['participant_id', 'participant_type'];

    protected $casts = ['settings' => 'array'];

    /**
     * Conversation initiator
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function initiator() {
        return $this->morphTo();
    }

    /**
     * Conversation participant
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function participant() {
        return $this->morphTo();
    }

    /**
     * Conversation messages
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages() {
        return $this->hasMany(Message::class, 'conversation_id');
    }

    /**
     * @return Builder
     */
    public function unreadMessages() {
        return $this->messages()->whereNull('read_at');
    }

    /**
     * Number of unread messages in this conversation
     *
     * @return int
     */
    public function unreadCount() {
        return $this->unreadMessages()->count();
    }

    public function toBeReadBy(Model $converser) {
        return $this->unreadMessages()->get()->reject(function (Message $message) use ($converser) {
            return $message->sender->is($converser);
        });
    }

    /**
     * @param Model $converser
     * @return int
     */
    public function unreadBy(Model $converser) {
        return $this->toBeReadBy($converser)->count();
    }

    /**
     * @param Model $converser
     * @return int
     */
    public function markReadBy(Model $converser) {
        $count = $this->unreadBy($converser);
        $this->toBeReadBy($converser)->each(function (Message $message) {
            app(MessageRepository::class)->update($message, ['read_at' => now()]);
        });
        return $count;
    }

    /**
     * Latest message
     *
     * @return Model|null|object|static|Message
     */
    public function LatestMessage() {
        return $this->messages()->latest()->first();
    }

    /**
     * Get setting
     *
     * @param $item
     * @return mixed
     */
    public function settings($item) {
        return collect($this->settings)->get($item, '');
    }

    /**
     * @param Model $participant
     * @return bool
     */
    public function participates(Model $participant) {
        return $participant->is($this->participant) || $participant->is($this->initiator);
    }
}
