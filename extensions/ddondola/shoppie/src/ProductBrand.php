<?php

namespace Shoppie;

use Illuminate\Database\Eloquent\Model;
use Shoppie\Traits\Identifier;

class ProductBrand extends Model
{
    use Identifier;

    protected $fillable = ['name', 'code', 'description'];

    public function products() {
        return $this->hasMany(Product::class, 'brand_id');
    }

    public function shop() {
        return $this->belongsTo(Shop::class, 'shop_id');
    }

    public function productCount() {
        return $this->products()
            ->where('active', "=", 1)
            ->whereHas('media')
            ->count();
    }
}
