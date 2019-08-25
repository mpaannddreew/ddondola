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
    public function find($id) {
        return Transaction::find($id);
    }

    public function create(array $attributes) {
        return Transaction::create($attributes);
    }
}