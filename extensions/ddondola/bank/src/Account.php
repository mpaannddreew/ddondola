<?php

namespace Bank;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $casts = ['data' => 'array'];

    /**
     * Get account holder
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function holder()
    {
        return $this->morphTo();
    }

    /**
     * Get account data value
     *
     * @param $value
     * @return mixed
     */
    public function data($value) {
        return collect($this->data)->get($value, '');
    }
}