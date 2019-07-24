<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 17/04/2019
 * Time: 21:45
 */

namespace Bank\Repositories;


use Bank\Account;
use Illuminate\Database\Eloquent\Model;

class AccountRepository
{
    /**
     * Create a new account
     *
     * @param Model $holder
     * @return Account
     */
    public function create(Model $holder) {
        // todo remote account creation via rave
        if (is_null($holder->account)) {
            return $holder->account()->save(new Account([]));
        }

        return $holder->account;
    }

    /**
     * Get admin account
     *
     * @return Account
     */
    public function adminAccount() {
        $admin = Account::whereNull("holder_type")->whereNull("holder_id")->where('admin', true)->first();
        if (!$admin) {
            return Account::create(['admin' => true]);
        }

        return $admin;
    }
}
