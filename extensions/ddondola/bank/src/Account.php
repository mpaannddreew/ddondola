<?php

namespace Bank;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
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

    public function transactions() {
        return $this->hasMany(Transaction::class, 'account_id');
    }

    public function debits() {
        return $this->transactions()->where('debit', 1)->get();
    }

    public function credits() {
        return $this->transactions()->where('credit', 1)->get();
    }

    public function debit($amount, $note = null) {
        return app(Ledger::class)->debit($this, $amount, $note);
    }

    public function credit($amount, $note = null) {
        return app(Ledger::class)->credit($this, $amount, $note);
    }

    public function balance() {
        return app(Ledger::class)->balance($this);
    }
}