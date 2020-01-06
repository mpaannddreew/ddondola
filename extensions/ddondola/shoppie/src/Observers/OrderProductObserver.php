<?php

namespace Shoppie\Observers;
use Bank\Bank;
use Shoppie\Events\OrderRowUpdated;
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
        $order = $this->orders->id($orderProduct->order_id);
        $product = $order->getProduct($orderProduct->product_id);
        $escrow = $product->orderPivot->associatedEscrow();
        if ($escrow) {
            if (!$escrow->settled()) {
                if ($product->orderPivot->cancelled) {
                    $this->bank->reverseEscrow($escrow);
                    // todo notify cancellation
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
                    $this->bank->completeEscrow($escrow);
                }
            }
        } else {
            if ($product->orderPivot->cancelled) {
                // todo notify cancellation
            }
        }

        broadcast(new OrderRowUpdated($order, $product));
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
