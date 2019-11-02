<?php

namespace Bank\Commands;

use Bank\Bank;
use Illuminate\Console\Command;

class BankAccount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bank:account 
                            {--type=admin : Type of system base account to create}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup base system bank accounts';

    /**
     * @var Bank
     */
    protected $bank;

    /**
     * @var array
     */
    protected $systemAccounts = ['admin'];

    /**
     * Create a new command instance.
     *
     * @param Bank $bank
     */
    public function __construct(Bank $bank)
    {
        parent::__construct();
        $this->bank = $bank;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $accountType = $this->option('type');
        if(!collect($this->systemAccounts)->contains(function ($value, $key) use ($accountType) {
            return $value == $accountType;
        })){
            $this->error("account type ($accountType) cannot be created!");
            return;
        }
        $account = $this->bank->adminAccount();
        $this->info("<info>$account</info>");

        return;
    }
}
