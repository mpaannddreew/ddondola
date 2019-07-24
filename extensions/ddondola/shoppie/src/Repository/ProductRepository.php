<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2018-09-11
 * Time: 9:47 PM
 */

namespace Shoppie\Repository;


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
    public function update(Product $product, Category $category = null, Brand $brand = null, $productData) {
        if ($category)
            if (!$product->subcategory->is($category))
                $product->subcategory_id = $category->id;

        if ($brand)
            if (!$product->brand->is($brand))
                $product->brand_id = $brand->id;

        foreach ($productData as $key => $value) {
            if ($key == 'attributes' || $key == 'minimum_stock') {
                $settings = $product->settings;
                $settings[$key] = $value;
                $product->settings = $settings;
            } else {
                $product->{$key} = $value;
            }
        }

        $product->save();

        return $product;
    }

    /**
     * Publish product
     *
     * @param Product $product
     * @return bool
     */
    public function publish(Product $product) {
        if (!$product->isPublished()) {
            $product->active = 1;
            $product->save();

            return true;
        }

        return false;
    }

    /**
     * Un publish product
     *
     * @param Product $product
     * @return bool
     */
    public function unPublish(Product $product) {
        if ($product->isPublished()) {
            $product->active = 0;
            $product->save();

            return true;
        }

        return false;
    }

    public function builder() {
        return Product::select();
    }

    public function all() {
        return Product::all();
    }

    public function fromIds(array $ids) {
        return Product::whereIn('id', $ids);
    }
}