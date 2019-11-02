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
     * Pending withdraw sum
     *
     * @param Account $account
     * @return int
     */
    protected function pendingWithdrawSum(Account $account) {
        return $account->withdrawRequests()
            ->where('processed', false)
            ->get()
            ->sum(function (WithdrawRequest $request) {
                return (int)$request->amount;
            });
    }

    /**
     * Pending outgoing escrow sum
     *
     * @param Account $account
     * @return int
     */
    protected function pendingOutgoingEscrowsSum(Account $account) {
        return $account->outgoingEscrows()
            ->where('completed', false)
            ->where('reversed', false)
            ->get()
            ->sum(function(Escrow $escrow) {
                return (int)$escrow->amount;
            });
    }

    /**
     * Available account balance
     *
     * @param Account $account
     * @return int
     */
    public function balance(Account $account) {
        return $this->actualBalance($account) - ($this->pendingWithdrawSum($account) + $this->pendingOutgoingEscrowsSum($account));
    }

    /**
     * Actual account balance
     *
     * @param Account $account
     * @return int
     */
    public function actualBalance(Account $account) {
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
     */
    public function credit(Account $account, $amount, $note = null) {
        return $this->transactions->create(['account_id' => $account->getKey(), 'amount' => $amount, 'credit' => true, 'note' => $note]);
    }
}