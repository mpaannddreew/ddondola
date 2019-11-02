<?php

namespace Bank;

use Ddondola\EcryptableModel;

class WithdrawRequest extends EcryptableModel
{
    protected $encryptable = ['amount'];

    protected $fillable = ['amount', 'account_number', 'recipient', 'processed'];

    protected $casts = [
        'recipient' => 'array',
        'processed' => 'bool'
    ];

    /**
     * Account that holds this request
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account() {
        return $this->belongsTo(Account::class);
    }
}
