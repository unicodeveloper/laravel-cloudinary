<?php

/*
 * This file is part of the Laravel Cloudinary package.
 *
 * (c) Prosper Otemuyiwa <prosperotemuyiwa@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Cloudinary Configuration
    |--------------------------------------------------------------------------
    |
    | An HTTP or HTTPS URL to notify your application (a webhook) when the process of uploads, deletes, and any API
    | that accepts notification_url has completed.
    |
    |
    */
    'notification_url' => env('CLOUDINARY_NOTIFICATION_URL', ''),


    /*
    |--------------------------------------------------------------------------
    | Cloudinary Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your Cloudinary settings. Cloudinary is a cloud hosted
    | media management service for all file uploads, storage, delivery and transformation needs.
    |
    |
    */

    'account_details' => [

        'account' => [
            /**
             * Cloud Name From Cloudinary Dashboard
             *
             */
            'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),

            /**
            * API Key From Cloudinary Dashboard
            *
            */
            'api_key' => env('CLOUDINARY_API_KEY'),

            /**
             * API Secret From Cloudinary Dashboard
             *
             */
            'api_secret' => env('CLOUDINARY_API_SECRET')
        ],

        'url' => [
            'secure' => true
        ]
    ]
];
