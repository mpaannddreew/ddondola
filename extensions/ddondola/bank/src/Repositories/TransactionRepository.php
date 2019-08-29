<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 25/08/2019
 * Time: 15:06
 */

namespace Bank\Repositories;


use Bank\Transaction;

class TransactionRepository
{
    /**
     * Get transaction by id
     *
     * @param $id
     * @return Transaction
     */
    public function find($id) {
        return Transaction::find($id);
    }

    /**
     * Create a new transaction
     *
     * @param array $attributes
     * @return Transaction
     */
    public function create(array $attributes) {
        return Transaction::create($attributes);
    }
}