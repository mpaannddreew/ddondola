<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 26/08/2019
 * Time: 19:35
 */

namespace Bank\Processors;


use Bank\Escrow;
use Bank\Repositories\EscrowRepository;

class EscrowProcessor
{
    /**
     * @var EscrowRepository
     */
    protected $escrows;

    public function __construct(EscrowRepository $escrows)
    {
        $this->escrows = $escrows;
    }

    public function reverse(Escrow $escrow) {
        if ($escrow->completed || $escrow->reversed) {
            // todo notify about $escrow status
            return;
        }

        // todo reverse escrow
    }

    public function complete(Escrow $escrow) {
        if ($escrow->completed || $escrow->reversed) {
            // todo notify about $escrow status
            return;
        }

        // todo complete escrow
    }
}