<?php

namespace Shoppie;

use Illuminate\Database\Eloquent\Model;
use Shoppie\Traits\Identifier;

class Order extends Model
{
    use Identifier;

    protected $fillable = ['code'];

    /**
     * Buyer that made this order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function by() {
        return $this->belongsTo(config('shoppie.buyer'), 'user_id');
    }

    /**
     * Products ordered for
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products() {
        return $this->belongsToMany(Product::class, 'order_product',
            'order_id', 'product_id')->as('orderPivot')
            ->withTimestamps()->using(OrderProduct::class)
            ->withPivot(['price', 'quantity', 'id', 'receipt_confirmed', 'delivery_confirmed']);
    }

    public function isHandledBy(Shop $shop) {
        return $this->products->reject(function (Product $product) use($shop) {
            return !$product->shop()->is($shop);
        })->count() > 0;
    }

    /**
     * Total amount of this order
     *
     * @return int
     */
    public function sum() {
        return $this->products->sum(function (Product $product) {
            return $product->orderPivot->sum();
        });
    }
    
    public function productCount() {
        return $this->products->count();
    }

    public function currencyCode() {
        return $this->by->country->currencyCode();
    }

    public function firstProduct() {
        return $this->products()->first();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->code = \Illuminate\Support\Str::uuid()->toString();
        });

        static::deleting(function ($model) {
            $model->products->detach();
        });
    }
}
