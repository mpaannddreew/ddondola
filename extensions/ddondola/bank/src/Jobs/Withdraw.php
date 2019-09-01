<?php

namespace Bank\Jobs;

use Bank\Account;
use Bank\Processors\TransactionProcessor;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class Withdraw implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Account
     */
    protected $account;

    /**
     * @var
     */
    protected $amount;

    /**
     * Create a new job instance.
     *
     * @param Account $account
     * @param $amount
     */
    public function __construct(Account $account, $amount)
    {
        $this->account = $account;
        $this->amount = $amount;
    }

    /**
     * Execute the job.
     *
     * @param TransactionProcessor $processor
     * @return void
     * @throws \Exception
     */
    public function handle(TransactionProcessor $processor)
    {
        $processor->withdraw($this->account, $this->amount);
    }
}
