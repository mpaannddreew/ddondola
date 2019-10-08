<?php

namespace Shoppie;

use Ddondola\User;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = ['quantity', 'note', 'in', 'out', 'user_id', 'product_id'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
