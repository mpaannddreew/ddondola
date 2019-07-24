<?php

namespace Bank;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['transaction_id', 'transaction_type', 'amount', 'currency', 'status', 'data'];

    protected $casts = ['data' => 'array'];

    public function transactor() {
        return $this->morphTo();
    }

    /**
     * Get payment data value
     *
     * @param $value
     * @return mixed
     */
    public function data($value) {
        return collect($this->data)->get($value, '');
    }
}
