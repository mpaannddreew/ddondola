<?php

namespace Shoppie;

use Bank\Escrow;
use Bank\Repositories\EscrowRepository;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderProduct extends Pivot
{
    public $incrementing = true;

    protected $casts = [
        'price' => 'integer',
        'quantity' => 'integer',
        'receipt_confirmed' => 'boolean',
        'delivery_confirmed' => 'boolean',
        'cancelled' => 'boolean',
    ];

    /**
     * Total amount in this order item
     *
     * @return float|int
     */
    public function sum() {
        return $this->price * $this->quantity;
    }

    /**
     * Compute commission
     *
     * @return float|int
     */
    public function commission() {
        return $this->sum() * ((int)config('shoppie.commission')/100);
    }

    /**
     * Compute payout
     *
     * @return float|int
     */
    public function payout() {
        return $this->sum() - $this->commission();
    }

    /**
     * @return Escrow|null
     */
    public function associatedEscrow() {
        return app(EscrowRepository::class)->findByMeta([
            'order' => $this->order_id,
            'product' => $this->product_id
        ]);
    }
}
