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
    public function transactions() {
        return $this->hasMany(Transaction::class, 'account_id');
    }

    public function debits() {
        return $this->transactions()->where('debit', 1)->get();
    }

    public function credits() {
        return $this->transactions()->where('credit', 1)->get();
    }

    public function balance() {
        return app(Ledger::class)->balance($this);
    }
}