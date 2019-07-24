<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 17/04/2019
 * Time: 21:10
 */

namespace Bank\Traits;


use Bank\Account;
use Bank\Facades\Bank;
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
     * Defines account details
     *
     * $details = [
     *      'account_bank',
     *      'account_number',
     *      'business_name',
     *      'business_email,
     *      'business_contact',
     *      'business_contact_mobile',
     *      'business_mobile',
     *      'meta' => [],
     *      'split_type',
     *      'split_value'
     * ]
     *
     * @return array
     */
    abstract public function accountDetails();

    /**
     * Create new account
     *
     * @return Account
     */
    public function createAccount() {
        return Bank::createAccount($this);
    }
}