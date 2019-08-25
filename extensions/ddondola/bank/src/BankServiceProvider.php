<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 17/04/2019
 * Time: 21:48
 */

namespace Bank;


use Bank\Commands\BankAccount;
use Illuminate\Support\ServiceProvider;

class BankServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../databases');
        $this->publishes([
            __DIR__.'/../config/bank.php' => config_path('bank.php'),
        ], 'bank.config');

        $this->publishes([
            __DIR__ . '/../resources/js/components' => resource_path('js/components/bank')
        ], 'bank.components');

        $this->publishes([
            __DIR__.'/../graphql/activity.graphql' => base_path('graphql/bank.graphql'),
        ], 'bank.graphql');

        $this->commands([
            BankAccount::class,
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('bank', Bank::class);
    }

    public function provides()
    {
        return ['bank'];
    }
}