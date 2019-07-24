<?php

namespace Messenger;

use Illuminate\Support\ServiceProvider;

class MessengerServiceProvider extends ServiceProvider
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
            __DIR__ . '/../resources/js/components' => resource_path('js/components/messenger')
        ], 'messenger.components');

        $this->publishes([
            __DIR__.'/../routes/graphql/messenger.graphql' => base_path('routes/graphql/messenger.graphql'),
        ], 'messenger.graphql');

        $this->publishes([
            __DIR__.'/../config/messenger.php' => config_path('messenger.php'),
        ], 'messenger.config');

        Messenger::bindExplicitly();

        require __DIR__. '/../routes/channels.php';
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('messenger', Messenger::class);
    }

    public function provides()
    {
        return ['messenger'];
    }
}
