<?php

namespace Shoppie;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderProduct extends Pivot
{
    protected $casts = ['receipt_confirmed' => 'boolean', 'delivery_confirmed' => 'boolean'];

    public function sum() {
        return $this->price * $this->quantity;
    }
}
