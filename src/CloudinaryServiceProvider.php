<?php

namespace Unicodeveloper\Cloudinary;

use Illuminate\Support\ServiceProvider;

class CloudinaryServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'unicodeveloper');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'unicodeveloper');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        // Register the service the package provides.
        $this->app->singleton('laravel-cloudinary', function ($app) {
            return new CloudinaryEngine;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laravel-cloudinary'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/cloudinary.php' => config_path('cloudinary.php'),
        ], 'laravel-cloudinary.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/unicodeveloper'),
        ], 'laravel-cloudinary.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/unicodeveloper'),
        ], 'laravel-cloudinary.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/unicodeveloper'),
        ], 'laravel-cloudinary.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
