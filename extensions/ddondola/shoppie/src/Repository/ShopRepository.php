<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2018-09-11
 * Time: 3:45 PM
 */

namespace Shoppie\Repository;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Shoppie\Shop;
use Shoppie\ShopCategory as Category;

class ShopRepository
{
    /**
     * Get shop from id
     *
     * @param $id
     * @return Shop
     */
    public function id($id) {
        return Shop::find($id);
    }

    /**
     * Get shop from code
     *
     * @param $code
     * @return Shop
     */
    public function code($code) {
        return Shop::where('code', "=", $code)->first();
    }

    /**
     * Create a new shop
     *
     * @param Model $shopOwner
     * @param Category $category
     * @param $shopData
     * @return Shop
     */
    public function create(Model $shopOwner, Category $category, $shopData)
    {
        return $shopOwner->shops()->create(array_merge($shopData, ['category_id' => $category->id]));
    }

    public function update(Shop $shop, $attributes) {
        $shop->update($attributes);
    }

    /**
     * Deactivate shop
     *
     * @param Shop $shop
     * @return bool
     */
    public function deactivateShop(Shop $shop) {
        if($shop->active) {
            $shop->active = 0;
            $shop->save();
        }

        return true;
    }

    /**
     * Activate shop
     *
     * @param Shop $shop
     * @return bool
     */
    public function activateShop(Shop $shop) {
        if(!$shop->active) {
            $shop->active = 1;
            $shop->save();
        }

        return true;
    }

    /**
     * Check if user manages shop
     *
     * @param Model $user
     * @param Shop $shop
     * @return bool
     */
    public function manages(Model $user, Shop $shop)
    {
        return $user->is($shop->owner);
    }

    /**
     * @return Builder
     */
    public function builder() {
        return Shop::select();
    }

    public function featured($limit) {
        // todo featured shops
        return $this->builder()->inRandomOrder()->take($limit)->get();
    }
}