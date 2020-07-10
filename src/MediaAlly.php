<?php

namespace Unicodeveloper\Cloudinary;

use Exception;
use Unicodeveloper\Cloudinary\Model\Media;


/**
 * MediaAlly
 *
 * Provides functionality for attaching Cloudinary files to an eloquent model.
 * Whether the model should automatically reload its media relationship after modification.
 *
 *
 */
trait MediaAlly
{

    /**
     * Relationship for all attached media.
     */
    public function medially()
    {
        return $this->morphMany(Media::class, 'medially');
    }


    /**
     * Attach Media Files to a Model
     */
    public function attachMedia($file)
    {
        if(! file_exists($file)) {
            throw new Exception('Please pass in a file that exists');
        }

        $response = resolve(CloudinaryEngine::class)->uploadFile($file->getRealPath());

        $media = new Media();
        $media->file_name = $response->getFileName();
        $media->file_url = $response->getSecurePath();
        $media->size = $response->getSize();
        $media->file_type = $response->getFileType();

        $this->medially()->save($media);
    }

    /**
     * Attach Remote Media Files to a Model
     */
    public function attachRemoteMedia($remoteFile)
    {
        $response = resolve(CloudinaryEngine::class)->uploadFile($remoteFile);

        $media = new Media();
        $media->file_name = $response->getFileName();
        $media->file_url = $response->getSecurePath();
        $media->size = $response->getSize();
        $media->file_type = $response->getFileType();

        $this->medially()->save($media);
    }

    /**
    * Get all the Media files relating to a particular Model record
    */
    public function fetchAllMedia()
    {
        return $this->medially()->get();
    }

    /**
    * Get the first Media file relating to a particular Model record
    */
    public function fetchFirstMedia()
    {
        return $this->medially()->first();
    }

    /**
    * Delete all files associated with a particular Model record
    */
    public function detachMedia()
    {

       $items = $this->medially()->get();

        foreach($items as $item) {
            resolve(CloudinaryEngine::class)->destroy($item->getFileName());
        }

        return $this->medially()->delete();
    }

    /**
    * Get the last Media file relating to a particular Model record
    */
    public function fetchLastMedia()
    {
        return $this->medially()->get()->last();
    }

    /**
    * Update the Media files relating to a particular Model record
    */
    public function updateMedia($file)
    {
        $this->detachMedia();
        $this->attachMedia($file);
    }

    /**
    * Update the Media files relating to a particular Model record (Specificially existing remote files)
    */
    public function updateRemoteMedia($file)
    {
        $this->detachMedia();
        $this->attachRemoteMedia($file);
    }

}