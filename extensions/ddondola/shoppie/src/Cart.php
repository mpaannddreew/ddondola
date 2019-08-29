<?php

namespace Shoppie;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['buyer_id'];

    /**
     * User that own this cart
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(config('shoppie.buyer'), 'buyer_id');
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
        return app(Shoppie::class)->addCartProduct($this, $product, $quantity);
    }

    /**
     * Remove product from cart
     *
     * @param Product $product
     * @return boolean
     */
    public function removeProduct(Product $product) {
        return app(Shoppie::class)->removeCartProduct($this, $product);
    }

    /**
     * Checkout current cart items
     *
     * @return Order
     */
    public function checkOut() {
        return app(Shoppie::class)->checkOut($this);
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
}
