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

    public function create(Product $product, $discount, Carbon $start_date, Carbon $end_date) {

        if ($product->hasActiveOffer()) {
            return null;
        }

        $offer = $product->offers()->create([
            'start_date' => $start_date,
            'end_date' => $end_date,
            'discount' => $discount,
            'cancel' => 0
        ]);

        return $offer;
    }
}