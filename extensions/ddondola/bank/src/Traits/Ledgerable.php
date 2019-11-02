<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 26/08/2019
 * Time: 12:51
 */

namespace Bank\Traits;


use Bank\Ledger;
use Bank\Transaction;

trait Ledgerable
{
    /**
     * Transaction history
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions() {
        return $this->hasMany(Transaction::class, 'account_id');
    }

    /**
     * Debit transactions
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function debits() {
        return $this->transactions()->where('debit', 1)->get();
    }

    /**
     * Credit transactions
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function credits() {
        return $this->transactions()->where('credit', 1)->get();
    }

    /**
     * Available account balance
     *
     * @return int
     */
    public function balance() {
        return app(Ledger::class)->balance($this);
    }

    /**
     * Actual account balance
     *
     * @return int
     */
    public function actualBalance() {
        return app(Ledger::class)->actualBalance($this);
    }
}