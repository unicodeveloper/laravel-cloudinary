<?php

namespace Unicodeveloper\Cloudinary;

use Illuminate\Support\ServiceProvider;
use Unicodeveloper\Cloudinary\Commands\BackupFilesCommand;
use Unicodeveloper\Cloudinary\Commands\UploadFileCommand;
use Unicodeveloper\Cloudinary\Commands\FetchFilesCommand;
use Unicodeveloper\Cloudinary\Commands\RenameFilesCommand;
use Unicodeveloper\Cloudinary\Commands\DeleteFilesCommand;
use Unicodeveloper\Cloudinary\Commands\GenerateArchiveCommand;
use Unicodeveloper\Cloudinary\Commands\GenerateZipCommand;

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
                BackupFilesCommand::class,
                UploadFileCommand::class,
                FetchFilesCommand::class,
                RenameFilesCommand::class,
                GenerateArchiveCommand::class,
                GenerateZipCommand::class,
                DeleteFilesCommand::class
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
