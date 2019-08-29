<?php

namespace Bank\Observers;

use Bank\Bank;
use Bank\Escrow;

class EscrowObserver
{
    /**
     * @var Bank
     */
    protected $bank;

    /**
     * EscrowObserver constructor.
     * @param Bank $bank
     */
    public function __construct(Bank $bank)
    {
        $this->bank = $bank;
    }

    /**
     * Handle the escrow "created" event.
     *
     * @param  \Bank\Escrow  $escrow
     * @return void
     */
    public function created(Escrow $escrow)
    {
        // todo money transfer
    }

    /**
     * Handle the escrow "updated" event.
     *
     * @param  \Bank\Escrow  $escrow
     * @return void
     */
    public function updated(Escrow $escrow)
    {
        //
    }

    /**
     * Handle the escrow "deleted" event.
     *
     * @param  \Bank\Escrow  $escrow
     * @return void
     */
    public function deleted(Escrow $escrow)
    {
        //
    }

    /**
     * Handle the escrow "restored" event.
     *
     * @param  \Bank\Escrow  $escrow
     * @return void
     */
    public function restored(Escrow $escrow)
    {
        //
    }

    /**
     * Handle the escrow "force deleted" event.
     *
     * @param  \Bank\Escrow  $escrow
     * @return void
     */
    public function forceDeleted(Escrow $escrow)
    {
        //
    }
}
