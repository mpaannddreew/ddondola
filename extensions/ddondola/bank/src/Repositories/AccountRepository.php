<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 17/04/2019
 * Time: 21:45
 */

namespace Bank\Repositories;


use Bank\Account;

class AccountRepository
{
    public function find($id) {
        return Account::find($id);
    }

    public function create(array $attributes) {
        return Account::create($attributes);
    }

    public function firstWhere($column, $value) {
        return Account::where($column, $value)->first();
    }
}
