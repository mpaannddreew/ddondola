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
    protected $transactions;

    public function __construct(TransactionRepository $transactions)
    {
        $this->transactions = $transactions;
    }

    protected function debitSum(Account $account) {
        return $account->debits()->sum(function(Transaction $transaction) {
            return (int)$transaction->amount;
        });
    }

    protected function creditSum(Account $account) {
        return $account->credits()->sum(function(Transaction $transaction) {
            return (int)$transaction->amount;
        });
    }

    public function balance(Account $account) {
        return $this->debitSum($account) - $this->creditSum($account);
    }

    public function debit(Account $account, $amount, $note = null) {
        return $this->transactions->create(['account_id' => $account->id, 'amount' => $amount, 'debit' => true, 'note' => $note]);
    }

    public function credit(Account $account, $amount, $note = null) {
        return $this->transactions->create(['account_id' => $account->id, 'amount' => $amount, 'credit' => true, 'note' => $note]);
    }
}