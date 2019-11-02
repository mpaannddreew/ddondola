<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 26/08/2019
 * Time: 19:35
 */

namespace Bank\Processors;


use Bank\Bank;
use Bank\Escrow;
use Bank\Jobs\Transfer;
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
     * @var Bank
     */
    protected $bank;

    /**
     * EscrowProcessor constructor.
     * @param EscrowRepository $escrows
     * @param OrderRepository $orders
     * @param Bank $bank
     */
    public function __construct(EscrowRepository $escrows, OrderRepository $orders, Bank $bank)
    {
        $this->escrows = $escrows;
        $this->orders = $orders;
        $this->bank = $bank;
    }

    /**
     * Create new escrows corresponding to an order
     *
     * @param Order $order
     */
    public function create(Order $order) {
        if ($order->paid_for) {
            return;
        }

        if ($order->activeSum() > $order->by->account->balance()) {
            // todo notify insufficient balance
            return;
        }

        DB::transaction(function () use ($order) {
            $order->activeRows()->each(function (Product $product) use ($order) {
                if (!$product->orderPivot->associatedEscrow()) {
                    $this->escrows->create([
                        'source_account_id' => $order->by->account->getKey(),
                        'destination_account_id' => $product->shop->account->getKey(),
                        'amount' => $product->orderPivot->sum(),
                        'meta' => [
                            'order' => $order->getKey(),
                            'product' => $product->getKey()
                        ]
                    ]);
                }
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

            $product = $this->orders
                ->id($escrow->meta('order'))
                ->getProduct($escrow->meta('product'));

            Transfer::dispatchNow($escrow->source, $escrow->destination, $escrow->amount, "Purchase (" . $product->name .")");
            if ($product->orderPivot->commission())
                Transfer::dispatchNow($escrow->destination, $this->bank->adminAccount(), $product->orderPivot->commission(), "Commission (" . $product->name .")");
        });
    }
}