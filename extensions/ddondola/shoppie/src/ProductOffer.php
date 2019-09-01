<?php

namespace Shoppie;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class ProductOffer extends Model
{
    protected $fillable = ['start_date', 'end_date', 'cancelled', 'discount'];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'cancelled' => 'bool'
    ];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function started() {
        return $this->start_date->isPast();
    }

    public function ended() {
        return $this->end_date->isPast();
    }

    public function isActive() {
        return !$this->cancelled && $this->started() && !$this->ended();
    }
}
