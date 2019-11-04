<?php

namespace Bank;

use Ddondola\EcryptableModel;
use Illuminate\Support\Str;

class WithdrawRequest extends EcryptableModel
{
    protected $encryptable = ['amount'];

    protected $fillable = ['amount', 'account_number', 'recipient', 'processed', 'code'];

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
