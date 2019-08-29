<?php

namespace Bank;

use Illuminate\Database\Eloquent\Model;

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
}
