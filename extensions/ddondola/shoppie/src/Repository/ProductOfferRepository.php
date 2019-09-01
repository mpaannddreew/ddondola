<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2019-03-05
 * Time: 11:11 AM
 */

namespace Shoppie\Repository;


use \Illuminate\Support\Carbon;
use Shoppie\Product;
use Shoppie\ProductOffer;

class ProductOfferRepository
{
    public function id($id) {
        return ProductOffer::find($id);
    }

    public function create(Product $product, array $attributes) {
        return $product->offers()->create($attributes);
    }
}