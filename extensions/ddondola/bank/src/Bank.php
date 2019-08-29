<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 17/04/2019
 * Time: 21:43
 */

namespace Bank;


use Bank\Jobs\CompleteEscrow;
use Bank\Jobs\ReverseEscrow;
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
     * @var Ledger
     */
    protected $ledger;

    /**
     * @var EscrowRepository
     */
    protected $escrows;

    /**
     * Bank constructor.
     * @param AccountRepository $accounts
     * @param Ledger $ledger
     * @param EscrowRepository $escrows
     */
    public function __construct(AccountRepository $accounts, Ledger $ledger, EscrowRepository $escrows)
    {
        $this->accounts = $accounts;
        $this->ledger = $ledger;
        $this->escrows = $escrows;
    }

    /**
     * Create a new account
     *
     * @param Model $holder
     * @return Account
     */
    public function createAccount(Model $holder) {
        if (is_null($holder->account)) {
            return $holder->account()->create([]);
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

    /**
     * Start escrow reversing process
     *
     * @param Escrow $escrow
     */
    public function reverseEscrow(Escrow $escrow) {
        ReverseEscrow::dispatch($escrow);
    }

    /**
     * Start escrow completion process
     *
     * @param Escrow $escrow
     */
    public function completeEscrow(Escrow $escrow) {
        CompleteEscrow::dispatch($escrow);
    }
}
