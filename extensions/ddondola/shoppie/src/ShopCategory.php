<?php

namespace Shoppie;

use Illuminate\Database\Eloquent\Model;
use Shoppie\Traits\Identifier;

class ShopCategory extends Model
{
    use Identifier;

    protected $fillable = ["name", "description"];

    /**
     * Shops in this category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shops() {
        return $this->hasMany(Shop::class, 'category_id');
    }

    /**
     * Products in this category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function products() {
        return $this->hasManyThrough(Product::class, Shop::class, 'category_id', 'shop_id');
    }

    /**
     * Number of shops in this category
     *
     * @return int
     */
    public function shopCount() {
        return $this->shops()->count();
    }

    /**
     * Number of products in this category
     *
     * @return int
     */
    public function productCount() {
        return $this->products()->count();
    }
}
