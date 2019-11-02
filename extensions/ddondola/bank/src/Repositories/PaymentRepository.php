<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 31/10/2019
 * Time: 12:38
 */

namespace Bank\Repositories;


use Bank\Account;
use Bank\Payment;
use Bank\WithdrawRequest;

class PaymentRepository
{
    /**
     * Find payment by id
     *
     * @param $id
     * @return Payment
     */
    public function find($id) {
        return Payment::find($id);
    }

    public function builder() {
        return Payment::query();
    }

    /**
     * Find Payment by reference
     *
     * @param $reference
     * @return \Illuminate\Database\Eloquent\Model|null|object|static|Payment
     */
    public function findByReference($reference) {
        return $this->builder()->where('reference', $reference)->first();
    }

    /**
     * @param Account $account
     * @param WithdrawRequest|null $request
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model|Payment
     */
    public function create(Account $account, array $attributes, WithdrawRequest $request = null) {
        if ($request) {
            $attributes['withdraw_request_id'] = $request->getKey();
        }

        return $account->payments()->create($attributes);
    }
}