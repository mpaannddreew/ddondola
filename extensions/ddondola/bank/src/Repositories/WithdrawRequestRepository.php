<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 31/10/2019
 * Time: 11:06
 */

namespace Bank\Repositories;


use Bank\Account;
use Bank\WithdrawRequest;

class WithdrawRequestRepository
{
    /**
     * Find withdraw request by id
     *
     * @param $id
     * @return WithdrawRequest
     */
    public function find($id) {
        return WithdrawRequest::find($id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function builder() {
        return WithdrawRequest::query();
    }

    /**
     * Create new withdraw request
     *
     * @param Account $account
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model|WithdrawRequest
     */
    public function create(Account $account, array $attributes) {
        return $account->withdrawRequests()->create($attributes);
    }

    /**
     * Update withdraw request
     *
     * @param WithdrawRequest $request
     * @param array $attributes
     */
    public function update(WithdrawRequest $request, array $attributes) {
        $request->update($attributes);
    }
}