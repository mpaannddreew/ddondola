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
use Bank\Repositories\EscrowRepository;
use Shoppie\Order;
use Shoppie\Product;

class EscrowProcessor
{
    /**
     * @var EscrowRepository
     */
    protected $escrows;

    /**
     * @var Bank
     */
    protected $bank;

    /**
     * EscrowProcessor constructor.
     * @param EscrowRepository $escrows
     * @param Bank $bank
     */
    public function __construct(EscrowRepository $escrows, Bank $bank)
    {
        $this->escrows = $escrows;
        $this->bank = $bank;
    }

    public function create(Order $order) {
        if ($order->sum() > $order->by->account->balance()) {
            // todo notify about insufficient account balance
            return;
        }

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
    }

    /**
     * Reverse escrow
     *
     * @param Escrow $escrow
     */
    public function reverse(Escrow $escrow) {
        if ($escrow->settled()) {
            // todo notify about $escrow status
            return;
        }

        // todo reverse escrow
        $this->escrows->update($escrow, ['reversed' => true]);
    }

    /**
     * Make escrow settlement
     *
     * @param Escrow $escrow
     */
    public function complete(Escrow $escrow) {
        if ($escrow->settled()) {
            // todo notify about $escrow status
            return;
        }

        // todo complete escrow
        $this->escrows->update($escrow, ['completed' => true]);
    }
}