<?php

namespace Unicodeveloper\Cloudinary;

use Illuminate\Support\Facades\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Blade;
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
        $this->bootMacros();
        $this->bootResources();
        $this->bootDirectives();
        $this->bootComponents();
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
     * Boot the package resources.
     *
     * @return void
     */
    protected function bootResources()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'cloudinary');
    }

    /**
     * Boot the package directives.
     *
     * @return void
     */
    protected function bootDirectives()
    {
        Blade::directive('cloudinaryJS', function() {
            return "<?php echo view('cloudinary::js'); ?>";
        });
    }

    /**
     * Boot the package components.
     *
     * @return void
     */
    protected function bootComponents()
    {
        Blade::component('cloudinary::components.button', 'upload-button');
    }

    /**
     * Boot the package macros that extends Laravel Uploaded File API.
     *
     * @return void
     */
    protected function bootMacros()
    {
        $engine = new CloudinaryEngine;

        UploadedFile::macro('storeOnCloudinary', function ($folder = null) use ($engine) {
            return $engine->uploadFile($this->getRealPath())->getSecurePath();
        });
    }
}
