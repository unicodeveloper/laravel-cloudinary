<div align="center">
    <h1> Laravel Cloudinary </h1>
</div>

<p align="center">
    <a href="https://packagist.org/packages/unicodeveloper/laravel-cloudinary">
        <img src="https://img.shields.io/scrutinizer/g/unicodeveloper/laravel-cloudinary.svg?style=flat-square" alt="Quality Score">
    </a>
    <a href="https://packagist.org/packages/unicodeveloper/laravel-cloudinary">
        <img src="https://img.shields.io/packagist/dt/unicodeveloper/laravel-cloudinary.svg?style=flat-square" alt="Total Downloads">
    </a>
    <a href="https://packagist.org/packages/unicodeveloper/laravel-cloudinary">
        <img src="https://poser.pugx.org/unicodeveloper/laravel-cloudinary/v/stable.svg" alt="Latest Stable Version">
    </a>
    <a href="https://packagist.org/packages/unicodeveloper/laravel-cloudinary">
        <img src="https://poser.pugx.org/unicodeveloper/laravel-cloudinary/license.svg" alt="License">
    </a>
</p>

> A Laravel Package for uploading, optimizing, transforming and delivering media files with Cloudinary. Furthermore, it provides a fluent and expressive API to easily attach your media files to Eloquent models.


## Usage

**Upload** a file (_Image_, _Video_ or any type of _File_) to **Cloudinary**:

```php

/**
*  Using the Cloudinary Facade
*/

// Upload an Image File to Cloudinary with One line of Code
$uploadedFileUrl = Cloudinary::upload($request->file('file')->getRealPath())->getSecurePath();

// Upload an Video File to Cloudinary with One line of Code
$uploadedFileUrl = Cloudinary::uploadVideo($request->file('file')->getRealPath())->getSecurePath();

// Upload any File to Cloudinary with One line of Code
$uploadedFileUrl = Cloudinary::uploadFile($request->file('file')->getRealPath())->getSecurePath();

/**
 *  This package also exposes a helper function you can use if you are not a fan of Facades
 *  Shorter, expressive, fluent using the
 *  cloudinary() function
 */

// Upload an Image File to Cloudinary with One line of Code
$uploadedFileUrl = cloudinary()->upload($request->file('file')->getRealPath())->getSecurePath();

// Upload an Video File to Cloudinary with One line of Code
$uploadedFileUrl = cloudinary()->uploadVideo($request->file('file')->getRealPath())->getSecurePath();

// Upload any File to Cloudinary with One line of Code
$uploadedFileUrl = cloudinary()->uploadFile($request->file('file')->getRealPath())->getSecurePath();

/**
 *  You can also skip the Cloudinary Facade or helper method and laravel-ize your uploads by simply calling the
 *  storeOnCloudinary() method on the file itself
 */

// Store the uploaded file on Cloudinary
$result = $request->file('file')->storeOnCloudinary();

// Store the uploaded file on Cloudinary
$result = $request->file->storeOnCloudinary();

// Store the uploaded file in the "lambogini" directory on Cloudinary
$result = $request->file->storeOnCloudinary('lambogini');

// Store the uploaded file in the "lambogini" directory on Cloudinary with the filename "prosper"
$result = $request->file->storeOnCloudinaryAs('lambogini', 'prosper');
```

## Installation

[PHP](https://php.net) 5.4+ or [HHVM](http://hhvm.com) 3.3+, and [Composer](https://getcomposer.org) are required.

To get the latest version of Laravel Cloudinary, simply require it

```bash
composer require unicodeveloper/laravel-cloudinary
```

Or add the following line to the require block of your `composer.json` file.

```
"unicodeveloper/laravel-cloudinary": "1.0.0-beta"
```

You'll then need to run `composer install` or `composer update` to download it and have the autoloader updated.


Once Laravel Cloudinary is installed, you need to register the service provider. Open up `config/app.php` and add the following to the `providers` key.

```php
'providers' => [
    ...
    Unicodeveloper\Cloudinary\CloudinaryServiceProvider::class,
    ...
]
```

> If you use **Laravel >= 5.5** you can skip this step and go to [**`configuration`**](https://github.com/unicodeveloper/laravel-cloudinary#configuration)

* `Unicodeveloper\Cloudinary\CloudinaryServiceProvider::class`

Also, register the Facade like so:

```php
'aliases' => [
    ...
    'Cloudinary' => Unicodeveloper\Cloudinary\Facades\Cloudinary::class,
    ...
]
```

## Configuration

You can publish the configuration file using this command:

```bash
php artisan vendor:publish --provider="Unicodeveloper\Cloudinary\CloudinaryServiceProvider"
```

A configuration-file named `cloudinary.php` with some sensible defaults will be placed in your `config` directory:

```php
<?php
return [
    'notification_url' => env('CLOUDINARY_NOTIFICATION_URL', ''),

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
            'api_secret' => env('CLOUDINARY_API_SECRET'),

            /**
            * Upload Preset From Cloudinary Dashboard
            *
            */
            'upload_preset' => env('CLOUDINARY_UPLOAD_PRESET')
        ],

        'url' => [
            'secure' => true
        ]
    ]
];
```

Open your .env file and add your Cloudinary cloud name, api key, api secret, and upload preset like so:

```php
CLOUDINARY_CLOUD_NAME=xxxxxxxxxxxxx
CLOUDINARY_API_KEY=xxxxxxxxxxxxx
CLOUDINARY_API_SECRET=xxxxxxxxxxxxx
CLOUDINARY_UPLOAD_PRESET=xxxxxxxxxxxxx
CLOUDINARY_NOTIFICATION_URL=
```

***Note:** You need to get these credentials from your [Cloudinary Dashboard](https://cloudinary.com/console)*

*If you are using a hosting service like heroku,forge,digital ocean, etc, please ensure to add the above details to your configuration variables.*


## How can I thank you?

Why not star the GitHub repo? I'd love the attention! Why not share the link for this repository on Twitter or HackerNews? Spread the word!

Don't forget to [follow me on twitter](https://twitter.com/unicodeveloper)!

Thanks!
Prosper Otemuyiwa.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
