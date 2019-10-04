<?php

namespace Shoppie\Observers;
use Bank\Bank;
use Shoppie\OrderProduct;
use Shoppie\Repository\OrderRepository;

class OrderProductObserver
{
    /**
     * @var OrderRepository
     */
    protected $orders;

    /**
     * @var Bank
     */
    protected $bank;

    /**
     * OrderProductObserver constructor.
     * @param OrderRepository $orders
     * @param Bank $bank
     */
    public function __construct(OrderRepository $orders, Bank $bank)
    {
        $this->orders = $orders;
        $this->bank = $bank;
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
                    $this->bank->reverseEscrow($escrow);
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
                    $this->bank->completeEscrow($escrow);
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
