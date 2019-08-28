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
        'cancelled' => 'boolean'
    ];

    public function sum() {
        return $this->cancelled ? 0 : $this->price * $this->quantity;
    }
}
