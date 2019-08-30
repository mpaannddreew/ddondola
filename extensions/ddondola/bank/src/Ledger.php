<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 25/08/2019
 * Time: 15:16
 */

namespace Bank;


use Bank\Repositories\TransactionRepository;

class Ledger
{
    /**
     * @var TransactionRepository
     */
    protected $transactions;

    /**
     * Ledger constructor.
     * @param TransactionRepository $transactions
     */
    public function __construct(TransactionRepository $transactions)
    {
        $this->transactions = $transactions;
    }

    /**
     * Debit sum of account
     *
     * @param Account $account
     * @return int
     */
    protected function debitSum(Account $account) {
        return $account->debits()->sum(function(Transaction $transaction) {
            return (int)$transaction->amount;
        });
    }

    /**
     * Credit sum of account
     *
     * @param Account $account
     * @return int
     */
    protected function creditSum(Account $account) {
        return $account->credits()->sum(function(Transaction $transaction) {
            return (int)$transaction->amount;
        });
    }

    /**
     * Balance of account
     *
     * @param Account $account
     * @return int
     */
    public function balance(Account $account) {
        return $this->debitSum($account) - $this->creditSum($account);
    }

    /**
     * Debit an account
     *
     * @param Account $account
     * @param $amount
     * @param null $note
     * @return Transaction
     */
    public function debit(Account $account, $amount, $note = null) {
        return $this->transactions->create(['account_id' => $account->getKey(), 'amount' => $amount, 'debit' => true, 'note' => $note]);
    }

    /**
     * Credit an account
     *
     * @param Account $account
     * @param $amount
     * @param null $note
     * @return Transaction
     * @throws \Exception
     */
    public function credit(Account $account, $amount, $note = null) {
        if ((int)$amount > $account->balance())
            throw new \Exception("Insufficient balance");

        return $this->transactions->create(['account_id' => $account->getKey(), 'amount' => $amount, 'credit' => true, 'note' => $note]);
    }
}