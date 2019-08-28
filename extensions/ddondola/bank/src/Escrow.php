<?php

namespace Bank;


class Escrow extends EcryptableModel
{
    protected $encryptable = ['amount'];

    protected $casts = [
        'completed' => 'bool',
        'reversed' => 'bool',
        'meta' => 'array'
    ];

    public function source() {
        return $this->belongsTo(Account::class, 'source_account_id');
    }

    public function destination() {
        return $this->belongsTo(Account::class, 'destination_account_id');
    }

    public function reverse() {
        app(Bank::class)->reverseEscrow($this);
    }

    public function complete() {
        app(Bank::class)->reverseEscrow($this);
    }
}
