<?php

namespace Bank;

use Bank\Traits\Ledgerable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Account extends Model
{
    use Ledgerable;

    protected $fillable = ['admin', 'code'];

    protected $casts = [
        'admin' => 'bool'
    ];

    /**
     * Get account holder
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function holder()
    {
        return $this->morphTo();
    }

    /**
     * Outgoing escrows
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function outgoingEscrows() {
        return $this->hasMany(Escrow::class, 'source_account_id');
    }

    /**
     * Incoming escrows
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function incomingEscrows() {
        return $this->hasMany(Escrow::class, 'destination_account_id');
    }

    /**
     * Account escrow
     *
     * @return \Illuminate\Database\Query\Builder|static
     */
    public function escrows() {
        return $this->outgoingEscrows()->union($this->incomingEscrows());
    }

    /**
     * Payments initiated on this account
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments() {
        return $this->hasMany(Payment::class, 'account_id');
    }

    /**
     * Withdraw requests intiated on this account
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function withdrawRequests() {
        return $this->hasMany(WithdrawRequest::class);
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