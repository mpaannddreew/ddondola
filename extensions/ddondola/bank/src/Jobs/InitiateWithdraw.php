<?php

namespace Bank\Jobs;

use Bank\Processors\PaymentProcessor;
use Bank\WithdrawRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class InitiateWithdraw implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $request;

    /**
     * Create a new job instance.
     *
     * @param WithdrawRequest $request
     */
    public function __construct(WithdrawRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @param PaymentProcessor $processor
     * @return void
     */
    public function handle(PaymentProcessor $processor)
    {
        $processor->withdraw($this->request);
    }
}
