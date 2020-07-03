<?php

namespace Unicodeveloper\Cloudinary\Commands;

use Illuminate\Console\Command;
use Unicodeveloper\Cloudinary\CloudinaryEngine;

/**
 * Class FetchFilesCommand
 *
 * @package Unicodeveloper\Cloudinary\Commands
 */
class FetchFilesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "cloudinary:fetch {publicId}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Fetch an asset's URL from Cloudinary";

    /**
     * Execute the console command.
     *
     * @param CloudinaryEngine $engine
     *
     * @return void
     */
    public function handle(CloudinaryEngine $engine)
    {
        if (! config('cloudinary.cloud_url')) {
            $this->warn('Please ensure your Cloudinary credentials are set before continuing.');

            return;
        }

        $publicId = $this->argument('publicId');

        if (! is_string($publicId)) {
            $this->warn("Please ensure a valid public Id is passed as an argument.");

            return;
        }

        $this->info("Fetching file...");

        try {
            $url = $engine->getImage($publicId)->toUrl(); // [CN] What about video/raw ?
            $this->info("File: {$url}");
        } catch (\Exception $exception) {
            // [CN] Error message looks confusing, we try to fetch file
            $this->warn("Renaming of file on Cloudinary failed because: {$exception->getMessage()}.");
        }
    }
}
