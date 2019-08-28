<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2018-11-20
 * Time: 1:27 PM
 */

namespace Shoppie\Repository;


use Shoppie\ProductBrand as Brand;
use Shoppie\ProductBrand;
use Shoppie\Shop;

class ProductBrandRepository
{
    public function all() {
        return Brand::all();
    }

    /**
     * Existing category from id
     *
     * @param $id
     * @return Brand
     */
    public function id($id) {
        return Brand::find($id);
    }

    /**
     * Existing category from code
     *
     * @param $code
     * @return Brand
     */
    public function code($code) {
        return Brand::where('code', $code)->first();
    }

    /**
     * @param Shop $shop
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model|Brand
     */
    public function create(Shop $shop, array $attributes) {
        return $shop->brands()->create($attributes);
    }

    /**
     * @param ProductBrand $brand
     * @param $update
     * @return ProductBrand
     */
    public function update(ProductBrand $brand, $update) {
        $brand->update($update);

        return $brand;
    }
}