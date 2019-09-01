<?php

namespace Shoppie\Observers;
use Bank\Jobs\CompleteEscrow;
use Bank\Jobs\ReverseEscrow;
use Shoppie\OrderProduct;
use Shoppie\Repository\OrderRepository;

class OrderProductObserver
{
    /**
     * @var OrderRepository
     */
    protected $orders;

    /**
     * OrderProductObserver constructor.
     * @param OrderRepository $orders
     */
    public function __construct(OrderRepository $orders)
    {
        $this->orders = $orders;
    }

    /**
     * Handle the order product "created" event.
     *
     * @param  \Shoppie\OrderProduct  $orderProduct
     * @return void
     */
    public function created(OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Handle the order product "updated" event.
     *
     * @param  \Shoppie\OrderProduct  $orderProduct
     * @return void
     */
    public function updated(OrderProduct $orderProduct)
    {
        $product = $this->orders->id($orderProduct->order_id)->getProduct($orderProduct->product_id);
        $escrow = $product->orderPivot->associatedEscrow();
        if ($product->orderPivot->cancelled) {
            if ($escrow) {
                if (!$escrow->settled()) {
                    ReverseEscrow::dispatch($escrow);
                }
            }
        }

        if ($product->orderPivot->receipt_confirmed && !$product->orderPivot->delivery_confirmed) {
            // todo notify seller
            // todo broadcast confirmation
        }

        if (!$product->orderPivot->receipt_confirmed && $product->orderPivot->delivery_confirmed) {
            // todo notify buyer
            // todo broadcast confirmation
        }

        if ($product->orderPivot->receipt_confirmed && $product->orderPivot->delivery_confirmed) {
            if ($escrow) {
                if (!$escrow->settled()) {
                    CompleteEscrow::dispatch($escrow);
                }
            }
        }
    }

    /**
     * Handle the order product "deleted" event.
     *
     * @param  \Shoppie\OrderProduct  $orderProduct
     * @return void
     */
    public function deleted(OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Handle the order product "restored" event.
     *
     * @param  \Shoppie\OrderProduct  $orderProduct
     * @return void
     */
    public function restored(OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Handle the order product "force deleted" event.
     *
     * @param  \Shoppie\OrderProduct  $orderProduct
     * @return void
     */
    public function forceDeleted(OrderProduct $orderProduct)
    {
        //
    }
}
