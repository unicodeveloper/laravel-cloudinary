<?php

namespace Unicodeveloper\Cloudinary\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Unicodeveloper\Cloudinary\CloudinaryEngine;

class RenameFilesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "cloudinary:rename {fromPublicId} {toPublicId}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rename an asset on Cloudinary';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(CloudinaryEngine $engine)
    {
        if(! config('cloudinary.account_details.account.cloud_name') ||
            ! config('cloudinary.account_details.account.api_key')   ||
            ! config('cloudinary.account_details.account.api_secret')) {
            $this->warn('Please ensure your Cloudinary credentials are set before continuing.');

            return;
        }

        $fromPublicId = $this->argument('fromPublicId');
        $toPublicId = $this->argument('toPublicId');

        if (! is_string($fromPublicId) || ! is_string($toPublicId)) {
           $this->warn("Please ensure a valid public Id is passed as an argument.");

           return;
        }

        $this->info("About to rename {$fromPublicId} file to {$toPublicId} on Cloudinary...");

        try {

            $engine->rename($fromPublicId, $toPublicId);

            $this->info('File renamed successfully on Cloudinary!');
        } catch (Exception $exception) {
            $this->warn("Renaming of file on Cloudinary failed because: {$exception->getMessage()}.");
        }
    }
}