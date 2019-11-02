<?php

namespace Bank;

use Ddondola\EcryptableModel;
use Illuminate\Support\Str;

class Transaction extends EcryptableModel
{
    protected $encryptable = ['amount'];

    protected $fillable = ['account_id', 'debit', 'credit', 'amount', 'note', 'code'];

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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->code = \Illuminate\Support\Str::uuid()->toString();
        });
    }

    public function miniCode() {
        return Str::upper(collect(explode('-', $this->code))->first());
    }
}
