<?php

namespace Bank;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['debit', 'credit', 'amount', 'note'];

    protected $casts = ['debit' => 'bool', 'credit' => 'bool'];

    public function account() {
        return $this->belongsTo(Account::class, 'account_id');
    }
}
