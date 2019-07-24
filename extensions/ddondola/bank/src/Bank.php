<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 17/04/2019
 * Time: 21:43
 */

namespace Bank;


use Bank\Repositories\AccountRepository;
use Bank\Repositories\EscrowRepository;
use Illuminate\Database\Eloquent\Model;

class Bank
{
    /**
     * @var AccountRepository
     */
    protected $accounts;

    /**
     * Bank constructor.
     * @param AccountRepository $accounts
     */
    public function __construct(AccountRepository $accounts)
    {
        $this->accounts = $accounts;
    }

    /**
     * Create a new account
     *
     * @param Model $accountHolder
     * @return Account
     */
    public function createAccount(Model $accountHolder) {
        return $this->accounts->create($accountHolder);
    }
}
