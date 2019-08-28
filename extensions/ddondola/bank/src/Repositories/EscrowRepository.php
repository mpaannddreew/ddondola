<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 26/08/2019
 * Time: 16:14
 */

namespace Bank\Repositories;


use Bank\Escrow;

class EscrowRepository
{
    public function find($id) {
        return Escrow::find($id);
    }

    public function create(array $attributes) {
        return Escrow::create($attributes);
    }

    public function update(Escrow $escrow, array $attributes) {
        $escrow->update($attributes);

        return $escrow;
    }
}