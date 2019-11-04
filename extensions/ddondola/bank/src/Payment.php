<?php

namespace Bank;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Payment extends Model
{
    protected $fillable = ['account_id', 'reference', 'data', 'status'];

    protected $casts = [
        'data' => 'array'
    ];

    /**
     * Account that initiated this payment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account() {
        return $this->belongsTo(Account::class, 'account_id');
    }

    /**
     * Check if payment was initiated for withdraw
     *
     * @return bool
     */
    public function isWithdraw() {
        return !is_null($this->withdraw_request_id);
    }

    public function miniCode() {
        return Str::upper(collect(explode('-', $this->reference))->first());
    }
}
