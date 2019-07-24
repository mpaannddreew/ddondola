<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2018-09-13
 * Time: 7:11 PM
 */

namespace Shoppie\Repository;


use Illuminate\Database\Eloquent\Model;
use Shoppie\Product;
use Shoppie\Stock;

class StockRepository
{
    /**
     * Get stock from id
     *
     * @param $id
     * @return Stock
     */
    public function id($id) {
        return Stock::find($id);
    }

    /**
     * Add a stock checkin record
     *
     * @param Product $product
     * @param $quantity
     * @param null $note
     * @param Model|null $by
     * @return Model|Stock
     */
    public function add(Product $product, $quantity, $note = null, Model $by = null)
    {
        return $this->create($product, $quantity, 'in', $note, $by);
    }

    /**
     * Add a stock checkout record
     *
     * @param Product $product
     * @param $quantity
     * @param $note
     * @param Model|null $by
     * @return Model|Stock|null
     */
    public function sub(Product $product, $quantity, $note = null, Model $by = null)
    {
        if ($product->hasStock() && $product->quantity() >= (int)$quantity)
            return $this->create($product, $quantity, 'out', $note, $by);

        return null;
    }

    /**
     * Add a stock record
     *
     * @param Product $product
     * @param $quantity
     * @param $type
     * @param $note
     * @param Model|null $by
     * @return Model|Stock
     */
    private function create(Product $product, $quantity, $type, $note = null, Model $by = null) {
        $stock = ['quantity' => $quantity, 'type' => $type];

        if ($note)
            $stock = collect($stock)->put('note', $note)->all();

        if ($by)
            $stock = collect($stock)->put('user_id', $by->id)->all();

        return $product->stock()->create($stock);
    }
}