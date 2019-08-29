<?php

namespace Bank;

class Transaction extends EcryptableModel
{
    protected $encryptable = ['amount'];

    protected $fillable = ['account_id', 'debit', 'credit', 'amount', 'note'];

    protected $casts = [
        'debit' => 'bool',
        'credit' => 'bool'
    ];

    /**
     * Account on which this transaction happened
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account() {
        return $this->belongsTo(Account::class, 'account_id');
    }
}
