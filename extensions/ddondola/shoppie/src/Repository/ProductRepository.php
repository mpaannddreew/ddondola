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
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model|Product
     */
    public function create(Category $category, Brand $brand, array $attributes) {
        $product = $category->products()->create(array_merge($attributes, ['brand_id' => $brand->id]));
        return $product;
    }

    /**
     * Edit product
     *
     * @param Product $product
     * @param Category|null $category
     * @param Brand|null $brand
     * @param array $attributes
     * @return Product
     */
    public function update(Product $product, Category $category = null, Brand $brand = null, array $attributes) {
        $data = [];
        if ($category)
            if (!$product->subcategory->is($category))
                $data['subcategory_id'] = $category->id;

        if ($brand)
            if (!$product->brand->is($brand))
                $data['brand_id'] = $brand->id;

        foreach ($attributes as $key => $value) {
            if ($key == 'settings') {
                $settings = $product->settings;
                foreach ($value as $k => $v) {
                    $settings[$k] = $v;
                }
                $data['settings'] = $settings;
            } else {
                $data[$key] = $value;
            }
        }

        $product->update($data);

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
        return $this->builder()->whereIn('id', $ids);
    }

    public function featured($limit) {
        // todo featured products
        return $this->builder()->has('media')->inRandomOrder()->take($limit)->get();
    }
}