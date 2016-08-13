<?php

namespace Hesto\Adminlte;

use Illuminate\Support\ServiceProvider;

class AdminlteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerInstallCommand();
    }

    /**
     * Register the make:view generator.
     */
    private function registerInstallCommand()
    {
        $this->app->singleton('command.hesto.install', function ($app) {
            return $app['Hesto\Adminlte\Commands\AdminlteInstallCommand'];
        });

        $this->commands('command.hesto.install');
    }

}
