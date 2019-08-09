<?php

namespace Messenger;

use Illuminate\Database\Eloquent\Model;

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
     * Number of unread messages in this conversation
     *
     * @return int
     */
    public function unReadCount() {
        return $this->messages()->whereNull('read_at')->count();
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
}
