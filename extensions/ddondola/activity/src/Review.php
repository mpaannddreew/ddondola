<?php

namespace Activity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Review extends Model
{
    protected $fillable = ['reviewer_id', 'rating', 'body'];

    public function reviewable() {
        return $this->morphTo();
    }

    public function reviewer() {
        return $this->belongsTo(config('activity.reviewer'), 'reviewer_id');
    }

    public function type() {
        $path = explode('\\', get_class($this->reviewable));
        return array_pop($path);
    }

    private function reviewee() {
        $reviewee = ['shop' => null, 'product' => null];
        $reviewee[Str::lower($this->type())] = $this->reviewable;

        return $reviewee;
    }

    public function reviewableTranslator() {
        return array_merge([
            'id' => $this->reviewable->getKey(),
            'type' => $this->type(),
        ], $this->reviewee());
    }
}
