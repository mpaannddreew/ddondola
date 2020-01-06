<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2018-09-14
 * Time: 8:15 PM
 */

namespace Shoppie\Repository;


use Illuminate\Database\Eloquent\Model;
use Shoppie\Order;


class OrderRepository
{
    /**
     * Get order from id
     *
     * @param $id
     * @return Order
     */
    public function id($id) {
        return Order::find($id);
    }

    /**
     * Get order from code
     *
     * @param $code
     * @return \Illuminate\Database\Eloquent\Builder|Model|object|Order
     */
    public function code($code) {
        return $this->builder()->where('code', $code)->first();
    }

    /**
     * Create new order
     *
     * @param Model $buyer
     * @param array $attributes
     * @return Order
     */
    public function create(Model $buyer, array $attributes) {
        return $buyer->orders()->create($attributes);
    }

    /**
     * Update order
     *
     * @param Order $order
     * @param array $attributes
     * @return Order
     */
    public function update(Order $order, array $attributes)
    {
        $order->update($attributes);

        return $order;
    }

    public function builder() {
        return Order::query();
    }
}