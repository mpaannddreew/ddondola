<?php

namespace Bank\Observers;

use Bank\Escrow;
use Shoppie\Repository\OrderRepository;

class EscrowObserver
{
    /**
     * @var OrderRepository
     */
    protected $orders;

    /**
     * EscrowObserver constructor.
     * @param OrderRepository $orders
     */
    public function __construct(OrderRepository $orders)
    {
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
        $product = $this->orders
            ->id($escrow->meta('order'))
            ->getProduct($escrow->meta('product'));

        // todo notify about escrow funds aside
    }

    /**
     * Handle the escrow "updated" event.
     *
     * @param  \Bank\Escrow  $escrow
     * @return void
     */
    public function updated(Escrow $escrow)
    {
        // todo notify about escrow update status
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
