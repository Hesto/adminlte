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
        $this->registerLayoutCommand();
    }

    /**
     * Register the adminlte:install command.
     */
    private function registerInstallCommand()
    {
        $this->app->singleton('command.hesto.adminlte.install', function ($app) {
            return $app['Hesto\Adminlte\Commands\AdminlteInstallCommand'];
        });

        $this->commands('command.hesto.adminlte.install');
    }

    /**
     * Register the adminlte:layout command.
     */
    private function registerLayoutCommand()
    {
        $this->app->singleton('command.hesto.adminlte.layout', function ($app) {
            return $app['Hesto\Adminlte\Commands\AdminlteLayoutCommand'];
        });

        $this->commands('command.hesto.adminlte.layout');
    }

}
