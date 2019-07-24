<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 08/05/2019
 * Time: 01:57
 */

namespace Bank\Traits;


use Bank\Payment;

trait Transactor
{
    public function transactions() {
        return $this->morphMany(Payment::class, 'transactor');
    }
}