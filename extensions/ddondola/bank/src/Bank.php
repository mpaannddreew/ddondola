<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 17/04/2019
 * Time: 21:43
 */

namespace Bank;


use Bank\Repositories\AccountRepository;
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
     * @param Model $holder
     * @return Account
     */
    public function createAccount(Model $holder) {
        if (is_null($holder->account)) {
            return $this->accounts->create(['holder_type' => get_class($holder), 'holder_id' => $holder->id]);
        }

        return $holder->account;
    }

    /**
     * Get admin account
     *
     * @return Account
     */
    public function adminAccount() {
        $admin = $this->accounts->firstWhere('admin', true);
        if (!$admin) {
            return $this->accounts->create(['admin' => true]);
        }

        return $admin;
    }

    /**
     * Get admin account
     *
     * @return Account
     */
    public function escrowAccount() {
        $escrow = $this->accounts->firstWhere('escrow', true);
        if (!$escrow) {
            return $this->accounts->create(['escrow' => true]);
        }

        return $escrow;
    }
}
