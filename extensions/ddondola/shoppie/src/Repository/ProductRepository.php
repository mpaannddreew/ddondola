<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2018-09-11
 * Time: 9:47 PM
 */

namespace Shoppie\Repository;


use Illuminate\Database\Eloquent\Builder;
use Shoppie\Product;
use Shoppie\ProductSubCategory as Category;
use Shoppie\ProductBrand as Brand;

class ProductRepository
{
    /**
     * Get a product from id
     *
     * @param $id
     * @return Product
     */
    public function id($id) {
        return Product::find($id);
    }

    /**
     * Get product from code
     *
     * @param $code
     * @return Product
     */
    public function code($code) {
        return Product::where('code', $code)->first();
    }

    /**
     * Create a new product
     *
     * @param Category $category
     * @param Brand $brand
     * @param $productData
     * @return \Illuminate\Database\Eloquent\Model|Product
     */
    public function create(Category $category, Brand $brand, $productData) {
        $product = $category->products()->create(array_merge($productData, ['brand_id' => $brand->id]));
        return $product;
    }

    /**
     * Edit product
     *
     * @param Product $product
     * @param Category|null $category
     * @param Brand|null $brand
     * @param $productData
     * @return Product
     */
    public function update(Product $product, Category $category = null, Brand $brand = null, array $productData) {
        if ($category)
            if (!$product->subcategory->is($category))
                $product->subcategory_id = $category->id;

        if ($brand)
            if (!$product->brand->is($brand))
                $product->brand_id = $brand->id;

        foreach ($productData as $key => $value) {
            if ($key == 'settings') {
                $settings = $product->settings;
                foreach ($value as $k => $v) {
                    $settings[$k] = $v;
                }
                $product->settings = $settings;
            } else {
                $product->{$key} = $value;
            }
        }

        $product->save();

        return $product;
    }

    /**
     * @return Builder
     */
    public function builder() {
        return Product::select();
    }

    public function all() {
        return Product::all();
    }

    public function fromIds(array $ids) {
        return Product::whereIn('id', $ids);
    }

    public function featured($limit) {
        // todo featured products
        return $this->builder()->inRandomOrder()->take($limit)->get();
    }
}