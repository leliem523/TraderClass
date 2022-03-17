<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'google' => [
        'client_id' => '1086586350342-t6bbbbulehsc8ikkkvqrk5n82i3lq1e0.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => '/login/google/callback',
    ],

    'facebook' => [
        'client_id' => '635212310909245',
        'client_secret' => 'df06b97a04b260bc62cfb760676cabdc',
        'redirect' => '/login/facebook/callback',
    ],

];
