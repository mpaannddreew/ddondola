<?php

namespace Bank;

use Bank\Traits\Ledgerable;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use Ledgerable;

    protected $fillable = ['admin', 'escrow'];

    protected $casts = [
        'admin' => 'bool',
        'escrow' => 'bool'
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

    public function outgoingEscrows() {
        return $this->hasMany(Escrow::class, 'source_account_id');
    }

    public function incomingEscrows() {
        return $this->hasMany(Escrow::class, 'destination_account_id');
    }
}