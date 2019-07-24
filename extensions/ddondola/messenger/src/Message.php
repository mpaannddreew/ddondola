<?php

namespace Messenger;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Message extends Model
{
    use HasMediaTrait;

    protected $fillable = ['sender_id', 'sender_type', 'message'];

    protected $casts = ['settings' => 'array'];

    /**
     * Conversation message belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function conversation() {
        return $this->belongsTo(Conversation::class, 'conversation_id');
    }

    /**
     * Message sender
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function sender() {
        return $this->morphTo();
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
