<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 07/10/2019
 * Time: 22:29
 */

namespace Shoppie\Repository;


use Shoppie\Cart;
use Shoppie\Order;
use Shoppie\Product;
use Shoppie\Stock;

class StockRepository
{
    /**
     * Determine product stock quantity
     *
     * @param Product $product
     * @return int
     */
    public function quantity(Product $product) {
        return $this->stockIn($product) - $this->stockOut($product);
    }

    /**
     * Determine out going stock quantity
     *
     * @param Product $product
     * @return int
     */
    public function stockOut(Product $product) {
        return $product->stockOut()->sum(function (Stock $stock) {
            return $stock->quantity;
        }) + $this->inCart($product) + $this->inOrders($product);
    }

    /**
     * Determine incoming stock quantity
     *
     * @param Product $product
     * @return int
     */
    public function stockIn(Product $product) {
        return $product->stockIn()->sum(function (Stock $stock) {
            return $stock->quantity;
        });
    }

    /**
     * Determine product quantity in carts
     *
     * @param Product $product
     * @return int
     */
    public function inCart(Product $product) {
        return $product->carts->sum(function (Cart $cart) {
            return $cart->cartPivot->quantity;
        });
    }

    /**
     * Determine product quantity in non cancelled orders
     *
     * @param Product $product
     * @return int
     */
    public function inOrders(Product $product) {
        return $product->orders->reject(function (Order $order) {
            return $order->orderPivot->cancelled;
        })->sum(function (Order $order) {
            return $order->orderPivot->quantity;
        });
    }

    /**
     * Create new stock entry
     *
     * @param Product $product
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model|Stock
     */
    public function create(Product $product, array $attributes) {
        return $product->stock()->create($attributes);
    }
}