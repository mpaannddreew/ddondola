<?php

namespace Shoppie;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Shoppie\Repository\CartRepository;

class Cart extends Model
{
    /**
     * User that own this cart
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(config('shoppie.buyer'), 'user_id');
    }

    /**
     * Products in this cart
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products() {
        return $this->belongsToMany(Product::class, 'cart_product',
            'cart_id', 'product_id')->as('cartPivot')
            ->withTimestamps()->using(CartProduct::class)->withPivot(['quantity', 'price', 'id']);
    }

    /**
     * Check if cart is empty
     *
     * @return bool
     */
    public function isEmpty() {
        return $this->products()->count() == 0;
    }

    /**
     * Check if product is in cart
     *
     * @param Product $product
     * @return bool
     */
    public function hasProduct(Product $product) {
        return $this->products->contains($product);
    }

    /**
     * Determine current quantity of a product in cart
     *
     * @param Product $product
     * @return int
     */
    public function currentProductQuantity(Product $product) {
        if ($this->hasProduct($product)) {
            return $this->products->first(function (Product $item) use ($product){
                return $item->is($product);
            })->cartPivot->quantity;
        }

        return 0;
    }

    /**
     * Total amount in cart
     *
     * @return int
     */
    public function sum() {
        return $this->products->sum(function (Product $product) {
            return $product->cartPivot->sum();
        });
    }

    /**
     * Add product to cart
     *
     * @param Product $product
     * @param $quantity
     * @return boolean
     */
    public function addProduct(Product $product, $quantity) {
        return app(CartRepository::class)->addProduct($this, $product, $quantity);
    }

    /**
     * Remove product from cart
     *
     * @param Product $product
     * @return boolean
     */
    public function removeProduct(Product $product) {
        return app(CartRepository::class)->removeProduct($this, $product);
    }

    /**
     * Checkout current cart items
     *
     * @return Order
     */
    public function checkOut() {
        return app(CartRepository::class)->checkOut($this);
    }

    /**
     * Empty the cart
     */
    public function makeEmpty() {
        $this->products()->detach();
    }

    /**
     * Get total number of products in cart
     *
     * @return int
     */
    public function productCount() {
        return $this->products()->count();
    }

    /**
     * Group cart products by their shops
     *
     * @return Collection
     */
    protected function groupByShop() {
        return $this->products->groupBy(function (Product $product) {
            return $product->brand->shop->code;
        });
    }

    /**
     * Determine sum products of a given shop in cart
     *
     * @param $code
     * @return int
     */
    protected function sumByShop($code) {
        return collect($this->groupByShop()->get($code))->sum(function (Product $product) use($code) {
            return $product->cartPivot->sum();
        });
    }

    /**
     * Calculate percentage
     *
     * @param $amount
     * @param $total_amount
     * @return float|int
     */
    protected function getPercentage($amount, $total_amount) {
        return ($amount/$total_amount) * 100;
    }

    /**
     * Calculate denominations
     *
     * @return \Illuminate\Support\Collection
     */
    public function getDenominations() {
        return $this->groupByShop()->keys()->map(function($item) {
            return [
                'id' => $item,
                'transaction_split_ratio' => round($this->getPercentage($this->sumByShop($item), $this->sum()), 0),
                'transaction_charge_type' => 'percentage',
                'transaction_charge' => '15'
            ];
        })->values();
    }
}
