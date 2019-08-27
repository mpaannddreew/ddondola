<?php

namespace Bank\Jobs;

use Bank\Escrow;
use Bank\Processors\EscrowProcessor;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ReverseEscrow implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Escrow
     */
    protected $escrow;

    /**
     * Create a new job instance.
     *
     * @param Escrow $escrow
     */
    public function __construct(Escrow $escrow)
    {
        $this->escrow = $escrow;
    }

    /**
     * Execute the job.
     *
     * @param EscrowProcessor $processor
     * @return void
     */
    public function handle(EscrowProcessor $processor)
    {
        $processor->reverse($this->escrow);
    }
}
