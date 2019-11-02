<?php

namespace Bank\Jobs;

use Bank\Processors\PaymentProcessor;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessCompleted implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var array
     */
    protected $response;

    /**
     * Create a new job instance.
     *
     * @param array $response
     */
    public function __construct(array $response)
    {
        $this->response = $response;
    }

    /**
     * Execute the job.
     *
     * @param PaymentProcessor $processor
     * @return void
     */
    public function handle(PaymentProcessor $processor)
    {
        $processor->complete($this->response);
    }
}
