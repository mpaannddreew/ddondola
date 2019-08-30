<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 30/08/2019
 * Time: 12:57
 */

namespace Bank\Processors;


use Bank\Account;
use Bank\Ledger;

class TransactionProcessor
{
    /**
     * @var Ledger
     */
    protected $ledger;

    /**
     * TransactionProcessor constructor.
     * @param Ledger $ledger
     */
    public function __construct(Ledger $ledger)
    {
        $this->ledger = $ledger;
    }

    /**
     * Deposit to an account
     *
     * @param Account $account
     * @param $amount
     */
    public function deposit(Account $account, $amount) {
        $this->ledger->debit($account, $amount, "Deposit");
    }

    /**
     * Withdraw from an account
     *
     * @param Account $account
     * @param $amount
     * @throws \Exception
     */
    public function withdraw(Account $account, $amount) {
        $this->ledger->credit($account, $amount, "Withdraw");
    }

    /**
     * Transfer amounts between two accounts
     *
     * @param Account $source
     * @param Account $destination
     * @param $amount
     * @param null $note
     * @throws \Exception
     */
    public function transfer(Account $source, Account $destination, $amount, $note = null) {
        $this->ledger->credit($source, $amount, $note);
        $this->ledger->debit($destination, $amount, $note);
    }
}