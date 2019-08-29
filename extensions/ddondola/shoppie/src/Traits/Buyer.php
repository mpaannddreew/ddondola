<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2018-09-14
 * Time: 7:21 PM
 */

namespace Shoppie\Traits;


use Shoppie\Cart;
use Shoppie\Order;
use Shoppie\Product;
use Shoppie\Repository\CartRepository;
use Shoppie\Repository\ProductRepository;
use Shoppie\Shoppie;

trait Buyer
{

    /**
     * Cart to hold products during shopping
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cart() {
        return $this->hasOne(Cart::class, 'buyer_id');
    }

    /**
     * @return Order
     */
    public function checkOut() {
        return $this->cart->checkOut();
    }

    /**
     * Create new cart
     *
     * @return Cart
     */
    public function createCart() {
        return app(Shoppie::class)->createCart($this);
    }

    /**
     * Orders placed
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders() {
        return $this->hasMany(Order::class, 'buyer_id');
    }

    public function products() {
        return $this->favorites(Product::class);
    }

    abstract public function productIdsForCommunityLikedShop();

    abstract public function productIdsForLikedShop();

    protected function recommendationIds() {
        return collect($this->productIdsForLikedShop())->merge($this->productIdsForCommunityLikedShop())->all();
    }

    public function recommendations() {
        return app(ProductRepository::class)->fromIds($this->recommendationIds());
    }
}