<?php

namespace Leandreaci\LaravelPermission;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class LaravelPermissionServiceProvider extends ServiceProvider
{
    /**
     * Indicates of loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the service provider
     *
     * @return null
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../migrations' => $this->app->databasePath().'/migrations'
        ], 'migrations');

//        $this->registerBladeDirectives();
    }

    /**
     * Register the service provider
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('permission', function ($app) {
            $auth = $app->make('Illuminate\Contracts\Auth\Guard');
            return new LaravelPermission($auth);
        });
    }

    /**
     * Register the blade directives.
     *
     * @return void
     */
    protected function registerBladeDirectives()
    {
        Blade::directive('can', function($expression) {
            return "<?php if (\\Permission::can({$expression})): ?>";
        });

        Blade::directive('endcan', function($expression) {
            return "<?php endif; ?>";
        });

        Blade::directive('canatleast', function($expression) {
            return "<?php if (\\Permission::canAtLeast({$expression})): ?>";
        });

        Blade::directive('endcanatleast', function($expression) {
            return "<?php endif; ?>";
        });

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['permission'];
    }
}