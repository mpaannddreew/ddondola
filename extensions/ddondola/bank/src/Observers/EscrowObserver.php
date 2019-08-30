<?php

namespace Bank\Observers;

use Bank\Bank;
use Bank\Escrow;
use Bank\Jobs\Transfer;
use Shoppie\Repository\OrderRepository;

class EscrowObserver
{
    /**
     * @var Bank
     */
    protected $bank;

    /**
     * @var OrderRepository
     */
    protected $orders;

    /**
     * EscrowObserver constructor.
     * @param Bank $bank
     * @param OrderRepository $orders
     */
    public function __construct(Bank $bank, OrderRepository $orders)
    {
        $this->bank = $bank;
        $this->orders = $orders;
    }

    /**
     * Handle the escrow "created" event.
     *
     * @param  \Bank\Escrow  $escrow
     * @return void
     */
    public function created(Escrow $escrow)
    {
        Transfer::dispatchNow($escrow->source, $this->bank->escrowAccount(), $escrow->amount, "Escrow payment");
    }

    /**
     * Handle the escrow "updated" event.
     *
     * @param  \Bank\Escrow  $escrow
     * @return void
     */
    public function updated(Escrow $escrow)
    {
        if ($escrow->completed) {
            $product = $this->orders
                ->id($escrow->meta('order'))
                ->getProduct($escrow->meta('product'));

            Transfer::dispatchNow($this->bank->escrowAccount(), $escrow->destination(), $product->orderPivot->payout(), "Escrow settlement payout");
            Transfer::dispatchNow($this->bank->escrowAccount(), $this->bank->adminAccount(), $product->orderPivot->commission(), "Escrow settlement commission");
        }

        if ($escrow->reversed) {
            Transfer::dispatchNow($this->bank->escrowAccount(), $escrow->source(), $escrow->amount, "Escrow rollback");
        }
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
