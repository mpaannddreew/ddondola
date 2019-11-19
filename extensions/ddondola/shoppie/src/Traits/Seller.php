<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2018-09-09
 * Time: 3:09 PM
 */

namespace Shoppie\Traits;


use Shoppie\Product;
use Shoppie\Repository\ShopRepository;
use Shoppie\Shop;
use Shoppie\ShopCategory;
use Shoppie\Shoppie;

trait Seller
{
    /**
     * Collection of shops owned
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shops() {
        return $this->hasMany(Shop::class, 'user_id');
    }

    /**
     * Create a new shop
     *
     * @param ShopCategory $category
     * @param array $attributes
     * @return Shop
     */
    public function newShop(ShopCategory $category, array $attributes) {
        return app(ShopRepository::class)->create($this, $category, $attributes);
    }

    /**
     * Check if user manages shop
     *
     * @param Shop $shop
     * @return bool
     */
    public function manages(Shop $shop) {
        return app(Shoppie::class)->manages($this, $shop);
    }

    /**
     * @param Product $product
     * @return bool
     */
    public function ownsProduct(Product $product) {
        return $this->manages($product->shop);
    }
}