<?php

namespace Messenger;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Messenger\Observers\MessageObserver;

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
            __DIR__ . '/../graphql/messenger.graphql' => base_path('graphql/messenger.graphql'),
        ], 'messenger.graphql');

        $this->publishes([
            __DIR__.'/../config/messenger.php' => config_path('messenger.php'),
        ], 'messenger.config');

        $this->bindExplicitly();
        $this->registerObservers();

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

    protected function registerObservers() {
        Message::observe(MessageObserver::class);
    }

    private function bindExplicitly()
    {
        Route::model('conversation', Conversation::class);
    }
}
