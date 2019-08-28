<?php

namespace Bank;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['account_id', 'reference', 'data', 'status'];

    protected $casts = [
        'data' => 'array'
    ];

    public function account() {
        return $this->belongsTo(Account::class, 'account_id');
    }
}
