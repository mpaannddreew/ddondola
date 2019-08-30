<?php

namespace Shoppie;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Shoppie\Traits\Identifier;

class Order extends Model
{
    use Identifier;

    protected $fillable = ['code', 'paid_for'];

    protected $casts = [
        'paid_for' => 'bool'
    ];

    /**
     * Buyer that made this order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function by() {
        return $this->belongsTo(config('shoppie.buyer'), 'buyer_id');
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
            ->withPivot(['price', 'quantity', 'id', 'receipt_confirmed', 'delivery_confirmed', 'cancelled', 'cancelled_by']);
    }

    /**
     * Get product in order
     *
     * @param $id
     * @return Product|null
     */
    public function getProduct($id) {
        return $this->products->first(function (Product $product) use ($id) {
            return $product->getKey() == $id;
        });
    }

    /**
     * Group order lines by shop
     *
     * @return Collection
     */
    public function groupByShop() {
        return $this->products->groupBy(function (Product $product) {
            return $product->brand->shop->code;
        });
    }

    /**
     * Check if shop holds products in this order
     *
     * @param Shop $shop
     * @return bool
     */
    public function isHandledBy(Shop $shop) {
        return $this->groupByShop()->keys()->contains($shop->code);
    }

    /**
     * Active order rows
     *
     * @return Collection
     */
    protected function activeRows() {
        return $this->products->reject(function (Product $product) {
            return $product->orderPivot->cancelled;
        });
    }

    /**
     * Total amount of this order
     *
     * @return int
     */
    public function sum() {
        return $this->activeRows()->sum(function (Product $product) {
            return $product->orderPivot->sum();
        });
    }

    /**
     * Determine sum products of a given shop in cart
     *
     * @param $code
     * @return int
     */
    public function sumByShop($code) {
        return collect($this->groupByShop()->get($code))->sum(function (Product $product) use($code) {
            return $product->orderPivot->sum();
        });
    }

    /**
     * Number of products in this order
     *
     * @return int
     */
    public function productCount() {
        return $this->products()->count();
    }

    /**
     * Currency of this order
     *
     * @return string
     */
    public function currencyCode() {
        return $this->by->country->currencyCode();
    }

    /**
     * First product in order
     *
     * @return Product
     */
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
