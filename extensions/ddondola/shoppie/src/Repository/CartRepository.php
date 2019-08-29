<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2018-10-12
 * Time: 11:24 AM
 */

namespace Shoppie\Repository;


use Illuminate\Database\Eloquent\Model;
use Shoppie\Cart;

class CartRepository
{
    /**
     * Get cart from id
     *
     * @param $id
     * @return Cart
     */
    public function id($id) {
        return Cart::find($id);
    }

    /**
     * @param Model $buyer
     * @param array $attributes
     * @return Cart
     */
    public function create(Model $buyer, array $attributes) {
        return $buyer->cart()->create($attributes);
    }
}