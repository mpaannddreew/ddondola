<?php

namespace Activity;

use Activity\Observers\ReviewObserver;
use Activity\Policies\ReviewPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class ActivityServiceProvider extends ServiceProvider
{
    protected $policies = [
        Review::class => ReviewPolicy::class,
    ];

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../databases');
        $this->publishes([
            __DIR__.'/../config/activity.php' => config_path('activity.php'),
        ], 'activity.config');

        $this->publishes([
            __DIR__ . '/../resources/js/components' => resource_path('js/components/activity')
        ], 'activity.components');

        $this->publishes([
            __DIR__ . '/../graphql/activity.graphql' => base_path('graphql/activity.graphql'),
        ], 'activity.graphql');
        
        $this->registerObservers();
        $this->registerPolicies();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    public function provides()
    {
        return ['activity'];
    }

    protected function registerPolicies()
    {
        foreach ($this->policies as $key => $value) {
            Gate::policy($key, $value);
        }
    }

    protected function registerObservers() {
        Review::observe(ReviewObserver::class);
    }
}
