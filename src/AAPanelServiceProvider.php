<?php

namespace PNS\AAPanel;

use Illuminate\Config\Repository as Config;
use Illuminate\Support\ServiceProvider;

class SEOToolsServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot()
    {
        $configFile = __DIR__ . '/../resources/config/aapanel.php';

        $this->publishes([
            $configFile => config_path('aapanel.php'),
        ]);

        $this->mergeConfigFrom($configFile, 'aapanel');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('aapanel', function ($app) {
            $url = $app['config']->get('aapanel.url');
            $key = $app['config']->get('aapanel.key');
            return new AAPanel($url, $key);
        });
    }
}
