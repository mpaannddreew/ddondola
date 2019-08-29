<?php

namespace Shoppie;

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
        'cancelled_by' => 'array'
    ];

    /**
     * Total amount in this order item
     *
     * @return float|int
     */
    public function sum() {
        return $this->cancelled ? 0 : $this->price * $this->quantity;
    }

    /**
     * Compute product discounted price
     *
     * @return float|int
     */
    protected function commission() {
        return $this->sum() * ((int)config('shoppie.commission')/100);
    }

    /**
     * Calculate denominations
     *
     * @return array
     */
    public function denominations() {
        return [
            'payout' => $this->sum() - $this->commission(),
            'commission' => $this->commission()
        ];
    }
}
