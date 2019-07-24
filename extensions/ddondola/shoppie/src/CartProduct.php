<?php

namespace Shoppie;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CartProduct extends Pivot
{
    public function sum() {
        return $this->price * $this->quantity;
    }
}
