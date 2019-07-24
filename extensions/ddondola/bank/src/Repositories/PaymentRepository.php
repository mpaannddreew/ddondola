<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 24/04/2019
 * Time: 13:16
 */

namespace Bank\Repositories;


use Bank\Payment;

class PaymentRepository
{
    /**
     * Get payment by id
     *
     * @param $id
     * @return Payment
     */
    public function byId($id) {
        return Payment::find($id);
    }

    /**
     * Get payment record
     *
     * @param $transaction_id
     * @param $method
     * @return Payment|null
     */
    public function payment($transaction_id, $method) {
        return Payment::where('transaction_id', $transaction_id)->where('method', $method)->first();
    }

    /**
     * Create a payment record
     *
     * @param $transaction_id
     * @param $transaction_type
     * @param $payment_method
     * @param $amount
     * @param $currency
     * @param $status
     * @return Payment
     */
    protected function create($transaction_id, $transaction_type, $payment_method, $amount, $currency, $status) {
        return Payment::create([
            'transaction_id' => $transaction_id, 'transaction_type' => $transaction_type, 'method' => $payment_method,
            'amount' => $amount, 'currency' => $currency, 'status' => $status
        ]);
    }

    /**
     * Create a deposit record
     *
     * @param $transaction_id
     * @param $payment_method
     * @param $amount
     * @param $currency
     * @param $status
     * @return Payment
     */
    public function deposit($transaction_id, $payment_method, $amount, $currency, $status) {
        return $this->create($transaction_id, 'deposit', $payment_method, $amount, $currency, $status);
    }

    /**
     * Create a withdraw record
     *
     * @param $transaction_id
     * @param $payment_method
     * @param $amount
     * @param $currency
     * @param $status
     * @return Payment
     */
    public function withdraw($transaction_id, $payment_method, $amount, $currency, $status) {
        return $this->create($transaction_id, 'withdraw', $payment_method, $amount, $currency, $status);
    }
}