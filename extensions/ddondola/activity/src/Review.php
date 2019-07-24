<?php

namespace Activity;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['reviewer_id', 'rating', 'body'];

    public function reviewable() {
        return $this->morphTo();
    }

    public function reviewer() {
        return $this->belongsTo(config('activity.reviewer'), 'reviewer_id');
    }

    private function type() {
        $path = explode('\\', get_class($this->reviewable));
        return array_pop($path);
    }

    private function reviewee() {
        $reviewee = ['shop' => null, 'product' => null];
        $reviewee[strtolower($this->type())] = $this->reviewable;

        return $reviewee;
    }

    public function reviewableTranslator() {
        return array_merge([
            'id' => $this->reviewable->id,
            'type' => $this->type(),
        ], $this->reviewee());
    }
}
