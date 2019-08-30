<?php

namespace Bank\Jobs;

use Bank\Account;
use Bank\Processors\TransactionProcessor;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class Transfer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Account
     */
    protected $source;

    /**
     * @var Account
     */
    protected $destination;

    /**
     * @var
     */
    protected $amount;

    /**
     * @var null
     */
    protected $note;

    /**
     * Create a new job instance.
     *
     * @param Account $source
     * @param Account $destination
     * @param $amount
     * @param null $note
     */
    public function __construct(Account $source, Account $destination, $amount, $note = null)
    {
        $this->source = $source;
        $this->destination = $destination;
        $this->amount = $amount;
        $this->note = $note;
    }

    /**
     * Execute the job.
     *
     * @param TransactionProcessor $processor
     * @return void
     */
    public function handle(TransactionProcessor $processor)
    {
        $processor->transfer($this->source, $this->destination, $this->amount, $this->note);
    }
}
