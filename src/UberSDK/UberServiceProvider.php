<?php

namespace nilsenj\Uber;

use Illuminate\Support\ServiceProvider;
use nilsenj\Uber\Uber;
use nilsenj\Uber\Facades\UberFacade;

/**
 * Class PackageServiceProvider
 * @package nilsenj\uberSDK
 */
class UberServiceProvider extends ServiceProvider
{

    /**
     * This will be used to register config & view in
     * your package namespace.
     *
     * @var string
     */
    protected $packageName = 'uber';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__ . '/../routes.php';

        // Register Views from your package
        $this->loadViewsFrom(__DIR__ . '/../views', $this->packageName);

        // Register your asset's publisher
        $this->publishes([
            __DIR__ . '/../assets' => public_path('vendor/' . $this->packageName),
        ], 'public');

        // Register your migration's publisher
        $this->publishes([
            __DIR__ . '/../database/migrations/' => base_path('/database/migrations')
        ], 'migrations');

        // Publish your seed's publisher
        $this->publishes([
            __DIR__ . '/../database/seeds/' => base_path('/database/seeds')
        ], 'seeds');

        // Publish your config
        $this->publishes([
            __DIR__ . '/../config/config.php' => config_path($this->packageName . '.php'),
        ], 'config');

        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', $this->packageName);

        $this->app->singleton(Uber::class, function ($app) {
            return new Uber($app);
        });

        $this->app->alias(
            Uber::class, UberContract::class
        );

        $this->app->alias('Ubder', UberFacade::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Uber::class, UberFacade::class, UberContract::class];
    }

}
