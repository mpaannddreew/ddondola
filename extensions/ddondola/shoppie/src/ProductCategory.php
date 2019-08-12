<?php

namespace Shoppie;

use Illuminate\Database\Eloquent\Model;
use Shoppie\Traits\Identifier;

class ProductCategory extends Model
{
    use Identifier;

    protected $fillable = ['name', 'code', 'description'];

    public function products() {
        return $this->hasManyThrough(Product::class, ProductSubCategory::class, 'category_id', 'subcategory_id');
    }

    /**
     * Shop this product category belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shop() {
        return $this->belongsTo(Shop::class, 'shop_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories() {
        return $this->hasMany(ProductSubCategory::class, 'category_id');
    }

    public function categoryCount() {
        return $this->categories->count();
    }

    public function productCount() {
        return $this->products()
            ->where('active', "=", 1)
            ->whereHas('media')
            ->count();
    }
}
