<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 31/10/2019
 * Time: 12:02
 */

namespace Bank\Processors;


use Bank\WithdrawRequest;

class PaymentProcessor
{
    protected $payments;

    public function __construct() {
    }

    public function withdraw(WithdrawRequest $request) {
        // todo rave api calls
    }

    public function deposit() {

    }

    public function complete(array $response) {
        // todo verify and reconcile completed payment
    }

    public function fail(array $response) {
        // todo verify and reconcile completed payment
    }
}