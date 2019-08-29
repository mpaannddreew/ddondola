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
     * @param Model $seller
     * @param Category $category
     * @param array $attributes
     * @return Shop
     */
    public function create(Model $seller, Category $category, array $attributes)
    {
        return $seller->shops()->create(array_merge($attributes, ['category_id' => $category->getKey()]));
    }

    public function update(Shop $shop, $attributes) {
        $shop->update($attributes);

        return $shop;
    }

    /**
     * @return Builder
     */
    public function builder() {
        return Shop::query();
    }

    public function featured($limit) {
        // todo featured shops
        return $this->builder()
            ->where('active', '=', 1)
            ->inRandomOrder()->take($limit)->get();
    }
}