<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 31/10/2019
 * Time: 12:02
 */

namespace Bank\Processors;


use Bank\Repositories\PaymentRepository;
use Bank\WithdrawRequest;

class PaymentProcessor
{
    /**
     * @var PaymentRepository
     */
    protected $payments;

    /**
     * PaymentProcessor constructor.
     * @param PaymentRepository $payments
     */
    public function __construct(PaymentRepository $payments) {
        $this->payments = $payments;
    }

    public function withdraw(WithdrawRequest $request) {
        // todo rave api calls and create payment entry
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