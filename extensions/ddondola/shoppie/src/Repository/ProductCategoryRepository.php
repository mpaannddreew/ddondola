<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2018-11-20
 * Time: 1:27 PM
 */

namespace Shoppie\Repository;


use Shoppie\ProductCategory as Category;
use Shoppie\Shop;

class ProductCategoryRepository
{
    public function all() {
        return Category::all();
    }

    /**
     * Existing category from id
     *
     * @param $id
     * @return Category
     */
    public function id($id) {
        return Category::find($id);
    }

    /**
     * Existing category from code
     *
     * @param $code
     * @return Category
     */
    public function code($code) {
        return Category::where('code', $code)->first();
    }

    /**
     * @param Shop $shop
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model|Category
     */
    public function create(Shop $shop, array $attributes) {
        return $shop->categories()->create($attributes);
    }

    /**
     * Update category
     *
     * @param Category $category
     * @param $update
     * @return Category
     */
    public function update(Category $category, $update) {
        $category->update($update);

        return $category;
    }
}