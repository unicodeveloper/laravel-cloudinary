<div align="center">
    <h2> Laravel Cloudinary </h2>
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

> A Laravel Package for easily uploading, optimizing, transforming and delivering media files with Cloudinary. It provides a fluent and expressive API to easily attach your media files to Eloquent models.


## Usage

Upload a file to Cloudinary:

```php

```

Let me explain the fluent methods this package provides a bit here.
```php
/**
 *  This fluent method does all the dirty work of sending a POST request with the form data
 *  to Paystack Api, then it gets the authorization Url and redirects the user to Paystack
 *  Payment Page. We've abstracted all of it, so you don't have to worry about that.
 *  Just eat your cookies while coding!
 */
Paystack::getAuthorizationUrl()->redirectNow();

/**
 * Alternatively, use the helper.
 */
paystack()->getAuthorizationUrl()->redirectNow();

/**
 * This fluent method does all the dirty work of verifying that the just concluded transaction was actually valid,
 * It verifies the transaction reference with Paystack Api and then grabs the data returned from Paystack.
 * In that data, we have a lot of good stuff, especially the `authorization_code` that you can save in your db
 * to allow for easy recurrent subscription.
 */
Paystack::getPaymentData();

/**
 * Alternatively, use the helper.
 */
paystack()->getPaymentData();

/**
 * This method gets all the customers that have performed transactions on your platform with Paystack
 * @returns array
 */
Paystack::getAllCustomers();

/**
 * Alternatively, use the helper.
 */
paystack()->getAllCustomers();


/**
 * This method gets all the plans that you have registered on Paystack
 * @returns array
 */
Paystack::getAllPlans();

/**
 * Alternatively, use the helper.
 */
paystack()->getAllPlans();


/**
 * This method gets all the transactions that have occurred
 * @returns array
 */
Paystack::getAllTransactions();

/**
 * Alternatively, use the helper.
 */
paystack()->getAllTransactions();

/**
 * This method generates a unique super secure cryptograhical hash token to use as transaction reference
 * @returns string
 */
Paystack::genTranxRef();

/**
 * Alternatively, use the helper.
 */
paystack()->genTranxRef();


/**
* This method creates a subaccount to be used for split payments
* @return array
*/
Paystack::createSubAccount();

/**
 * Alternatively, use the helper.
 */
paystack()->createSubAccount();


/**
* This method fetches the details of a subaccount
* @return array
*/
Paystack::fetchSubAccount();

/**
 * Alternatively, use the helper.
 */
paystack()->fetchSubAccount();


/**
* This method lists the subaccounts associated with your paystack account
* @return array
*/
Paystack::listSubAccounts();

/**
 * Alternatively, use the helper.
 */
paystack()->listSubAccounts();


/**
* This method Updates a subaccount to be used for split payments
* @return array
*/
Paystack::updateSubAccount();

/**
 * Alternatively, use the helper.
 */
paystack()->updateSubAccount();
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
