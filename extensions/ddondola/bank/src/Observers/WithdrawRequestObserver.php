<?php

namespace Bank\Observers;

use Bank\Jobs\InitiateWithdraw;
use Bank\Jobs\Withdraw;
use Bank\WithdrawRequest;

class WithdrawRequestObserver
{
    /**
     * Handle the withdraw request "created" event.
     *
     * @param  \Bank\WithdrawRequest  $withdrawRequest
     * @return void
     */
    public function created(WithdrawRequest $withdrawRequest)
    {
        InitiateWithdraw::dispatch($withdrawRequest);
    }

    /**
     * Handle the withdraw request "updated" event.
     *
     * @param  \Bank\WithdrawRequest  $withdrawRequest
     * @return void
     */
    public function updated(WithdrawRequest $withdrawRequest)
    {
        Withdraw::dispatch($withdrawRequest->account, $withdrawRequest->amount);
    }

    /**
     * Handle the withdraw request "deleted" event.
     *
     * @param  \Bank\WithdrawRequest  $withdrawRequest
     * @return void
     */
    public function deleted(WithdrawRequest $withdrawRequest)
    {
        //
    }

    /**
     * Handle the withdraw request "restored" event.
     *
     * @param  \Bank\WithdrawRequest  $withdrawRequest
     * @return void
     */
    public function restored(WithdrawRequest $withdrawRequest)
    {
        //
    }

    /**
     * Handle the withdraw request "force deleted" event.
     *
     * @param  \Bank\WithdrawRequest  $withdrawRequest
     * @return void
     */
    public function forceDeleted(WithdrawRequest $withdrawRequest)
    {
        //
    }
}
