<?php

namespace Ddondola\Providers;

use Ddondola\Observers\UserObserver;
use Ddondola\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);

        Blade::if('is_staff', function ($user) {
            return $user->is_staff;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
