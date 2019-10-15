<?php

namespace Lcjury\Administrative;

use Illuminate\Support\ServiceProvider;
use Lcjury\Administrative\Console\MakeAdministrativeCommand;

class AdministrativeServiceProvider extends ServiceProvider
{
    protected $defer = false;

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('command.make.administrative', function($app) {
            return new MakeAdministrativeCommand();
        });
        $this->commands('command.make.administrative');
    }

    /**
     * Get the services provided by the provider.
     * 
     * @return array
     */
    public function provides()
    {
        return 'command.make.administrative';
    }
}
