<?php

use App\Models\User;

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\Models\User\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'facebook' => [
        'client_id'     => env('FACEBOOK_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
        'redirect'      => env('APP_URL') . '/user/callback/facebook',
    ],

    'vkontakte' => [
        'client_id'     => env('VK_CLIENT_ID'),
        'client_secret' => env('VK_CLIENT_SECRET'),
        'redirect'      => env('APP_URL') . '/user/callback/vkontakte',
    ],

    'google' => [
        'client_id'     => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect'      => env('APP_URL') . '/user/callback/google',
    ],

    'odnoklassniki' => [
        'client_id' => env('ODNOKLASSNIKI_KEY'),
        'client_secret' => env('ODNOKLASSNIKI_SECRET'),
        'redirect'      => env('APP_URL') . '/user/callback/odnoklassniki',
    ],

    'twitter' => [
        'client_id'     => env('TWITTER_CLIENT_ID'),
        'client_secret' => env('TWITTER_CLIENT_SECRET'),
        'redirect'      => env('APP_URL') . '/user/callback/twitter',
    ],

    'yakassa' => [
        'test_mode'     => env('YAKASSA_TEST_MODE', true),
        'shop_id'       => env('YAKASSA_SHOP_ID', ''),
        'showcase_id'   => env('YAKASSA_SHOWCASE_ID', ''),
        'shop_password' => env('YAKASSA_SHOP_PASSWORD', ''),
    ],

    'robokassa' => [
        'login'              => env('ROBOKASSA_LOGIN', ''),
        'paymentPassword'    => env('ROBOKASSA_PAYMENT_PASSWORD', ''),
        'validationPassword' => env('ROBOKASSA_VALIDATION_PASSWORD', ''),
        'testMode'           => env('ROBOKASSA_TEST_MODE', true),
    ]

];
