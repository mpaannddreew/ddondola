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
     * @param array $shopData
     * @return Shop
     */
    public function newShop(ShopCategory $category, array $shopData) {
        return app(ShopRepository::class)->create($this, $category, $shopData);
    }

    /**
     * Check if user manages shop
     *
     * @param Shop $shop
     * @return bool
     */
    public function manages(Shop $shop) {
        return app(ShopRepository::class)->manages($this, $shop);
    }


    public function ownsProduct(Product $product) {
        return $this->manages($product->shop());
    }
}