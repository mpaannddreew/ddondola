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

    /**
     * Account from which escrow is initiated
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function source() {
        return $this->belongsTo(Account::class, 'source_account_id');
    }

    /**
     * Account to which escrow is intended
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function destination() {
        return $this->belongsTo(Account::class, 'destination_account_id');
    }

    /**
     * Reverse escrow
     */
    public function reverse() {
        app(Bank::class)->reverseEscrow($this);
    }

    /**
     * Complete escrow
     */
    public function complete() {
        app(Bank::class)->reverseEscrow($this);
    }

    /**
     * Check if escrow is settled (reversed or completed)
     *
     * @return bool
     */
    public function settled() {
        return $this->completed || $this->reversed;
    }
}
