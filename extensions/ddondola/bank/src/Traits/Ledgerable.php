<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 26/08/2019
 * Time: 12:51
 */

namespace Bank\Traits;


use Bank\Account;
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

    public function deposit($amount) {
        return app(Ledger::class)->debit($this, $amount, "deposit");
    }

    public function withdraw($amount) {
        return app(Ledger::class)->credit($this, $amount, "withdraw");
    }

    public function transfer(Account $account, $amount, $note = null) {
        return app(Ledger::class)->transfer($this, $account, $amount, $note);
    }

    public function balance() {
        return app(Ledger::class)->balance($this);
    }
}