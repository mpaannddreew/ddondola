<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 17/04/2019
 * Time: 21:10
 */

namespace Bank\Traits;


use Bank\Account;
use Bank\Bank;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait Holder
{
    /**
     * Holder's account
     *
     * @return MorphOne
     */
    public function account() {
        return $this->morphOne(Account::class, 'holder');
    }

    /**
     * Create new account
     *
     * @return Account
     */
    public function createAccount() {
        return app(Bank::class)->createAccount($this);
    }

    /**
     * Account balance
     *
     * @return int
     */
    public function accountBalance() {
        return $this->account->balance();
    }
}