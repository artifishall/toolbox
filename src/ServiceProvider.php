<?php namespace Artifishall\Toolbox;

use Illuminate\Routing\Router;
use Illuminate\Session\SessionManager;

use Artifishall\Toolbox\Console\DBBackup;
use Artifishall\Toolbox\Console\DBImport;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/toolbox.php', 'toolbox'
        );
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot(\Illuminate\Routing\Router $router)
    {
        $this->loadViewsFrom(__DIR__.'/views', 'toolbox');

        $this->publishes([
            __DIR__.'/views' => resource_path('views/vendor/toolbox'),
            __DIR__.'/config/toolbox.php' => config_path('toolbox.php'),
        ]);

        if ($this->app->runningInConsole()) {
          $this->commands([DBBackup::class, DBImport::class]);
        }

    }

}
