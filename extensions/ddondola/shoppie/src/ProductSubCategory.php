<?php

namespace Shoppie;

use Illuminate\Database\Eloquent\Model;
use Shoppie\Traits\Identifier;

class ProductSubCategory extends Model
{
    use Identifier;

    protected $fillable = ['name', 'description'];

    public function products() {
        return $this->hasMany(Product::class, 'subcategory_id');
    }

    public function category() {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function productCount() {
        return $this->products()->where('active', '=', 1)->count();
    }
}
