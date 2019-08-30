<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 26/08/2019
 * Time: 19:35
 */

namespace Bank\Processors;


use Bank\Escrow;
use Bank\Repositories\EscrowRepository;
use Illuminate\Support\Facades\DB;
use Shoppie\Order;
use Shoppie\Product;
use Shoppie\Repository\OrderRepository;

class EscrowProcessor
{
    /**
     * @var EscrowRepository
     */
    protected $escrows;

    /**
     * @var OrderRepository
     */
    protected $orders;

    /**
     * EscrowProcessor constructor.
     * @param EscrowRepository $escrows
     * @param OrderRepository $orders
     */
    public function __construct(EscrowRepository $escrows, OrderRepository $orders)
    {
        $this->escrows = $escrows;
        $this->orders = $orders;
    }

    /**
     * Create new escrows corresponding to an order
     *
     * @param Order $order
     */
    public function create(Order $order) {
        if ($order->sum() > $order->by->account->balance()) {
            return;
        }

        DB::transaction(function () use ($order) {
            $order->products->each(function (Product $product) use ($order) {
                $this->escrows->create([
                    'source_account_id' => $order->by->account->getKey(),
                    'destination_account_id' => $product->shop->account->getKey(),
                    'amount' => $product->orderPivot->sum(),
                    'meta' => [
                        'order' => $order->getKey(),
                        'product' => $product->getKey()
                    ]
                ]);
            });

            $this->orders->update($order, ['paid_for' => true]);
        });
    }

    /**
     * Reverse escrow
     *
     * @param Escrow $escrow
     */
    public function reverse(Escrow $escrow) {
        if ($escrow->settled()) {
            return;
        }

        DB::transaction(function () use ($escrow) {
            $this->escrows->update($escrow, ['reversed' => true]);
        });
    }

    /**
     * Make escrow settlement
     *
     * @param Escrow $escrow
     */
    public function complete(Escrow $escrow) {
        if ($escrow->settled()) {
            return;
        }

        DB::transaction(function () use ($escrow) {
            $this->escrows->update($escrow, ['completed' => true]);
        });
    }
}