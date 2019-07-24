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
     * @param $name
     * @param null $description
     * @return \Illuminate\Database\Eloquent\Model|Brand
     */
    public function create(Shop $shop, $name, $description = null) {
        return $shop->brands()->create([
            'name' => $name, 'description' => $description
        ]);
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