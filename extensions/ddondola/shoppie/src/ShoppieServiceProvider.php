<?php

namespace Shoppie;

use Illuminate\Support\Facades\Route;
use Shoppie\Observers\ProductObserver;
use Shoppie\Observers\ProductOfferObserver;
use Shoppie\Observers\ShopObserver;
use Shoppie\Policies\ProductBrandPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Shoppie\Policies\ProductCategoryPolicy;
use Shoppie\Policies\ProductOfferPolicy;
use Shoppie\Policies\ProductPolicy;
use Shoppie\Policies\ProductSubCategoryPolicy;
use Shoppie\Policies\ShopCategoryPolicy;
use Shoppie\Policies\ShopPolicy;

class ShoppieServiceProvider extends ServiceProvider
{
    protected $policies = [
        Shop::class => ShopPolicy::class,
        ProductBrand::class => ProductBrandPolicy::class,
        ProductCategory::class => ProductCategoryPolicy::class,
        ProductOffer::class => ProductOfferPolicy::class,
        Product::class => ProductPolicy::class,
        ProductSubCategory::class => ProductSubCategoryPolicy::class,
        ShopCategory::class => ShopCategoryPolicy::class
    ];

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/routes.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'shoppie');
        $this->loadMigrationsFrom(__DIR__ . '/../databases');

        $this->publishes([
            __DIR__.'/../config/shoppie.php' => config_path('shoppie.php'),
        ], 'shoppie.config');

        $this->publishes([
            __DIR__ . '/../resources/js/components' => resource_path('js/components/shoppie')
        ], 'shoppie.components');

        $this->publishes([
            __DIR__.'/../routes/graphql/shoppie.graphql' => base_path('routes/graphql/shoppie.graphql'),
        ], 'shoppie.graphql');

        $this->registerObservers();
        $this->registerPolicies();
        $this->bindExplicitly();
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
        return ['shoppie'];
    }

    protected function registerPolicies()
    {
        foreach ($this->policies as $key => $value) {
            Gate::policy($key, $value);
        }
    }

    protected function bindExplicitly() {
        Route::model('shop', Shop::class);
        Route::model('product', Product::class);
        Route::model('order', Order::class);
    }

    protected function registerObservers() {
        Shop::observe(ShopObserver::class);
        Product::observe(ProductObserver::class);
        ProductOffer::observe(ProductOfferObserver::class);
    }
}
