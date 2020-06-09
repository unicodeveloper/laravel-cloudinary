<?php

namespace Unicodeveloper\Cloudinary;

use Illuminate\Support\ServiceProvider;
use Unicodeveloper\Cloudinary\Commands\BackupFilesCommand;

class CloudinaryServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->bootDirectives();
        // $this->bootComponents();
        $this->bootCommands();
        $this->bootPublishing();
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        // Register the service the package provides.
        $this->app->singleton(CloudinaryEngine::class, function ($app) {
            return new CloudinaryEngine;
        });
    }


    public function bootCommands()
    {
        /**
        * Register Laravel Cloudinary Artisan commands
        */
        if ($this->app->runningInConsole()) {
            $this->commands([
                BackupFilesCommand::class
            ]);
        }
    }

    /**
     * Boot the package's publishable resources.
     *
     * @return void
     */
    protected function bootPublishing()
    {
        if ($this->app->runningInConsole()) {
            $config = realpath(__DIR__.'/../config/cloudinary.php');

            $this->publishes([
                $config => config_path('cloudinary.php')
            ]);
        }
    }

    /**
     * Boot the package directives.
     *
     * @return void
     */
    protected function bootDirectives()
    {

    }

    /**
     * Boot the package components.
     *
     * @return void
     */
    protected function bootComponents()
    {

    }
}
