<?php

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
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
        'client_id' => '2602776266614162',
        'client_secret' => '6d296dca25f1ce45312c3476552ebeb8',
        'redirect' => 'http://localhost:8000/callback',
    ],
    'twitter' => [
        'client_id' => '1Pov59jl4MZ2pMPQd2rA9vZda',
        'client_secret' => 'aIlXlASjw4MhBWRgLOGyJwfPDaf6wE0KbpMHNgGxHWpLFQaLAp',
        'redirect' => 'http://localhost:8000/callback/twitter',
    ],
];
