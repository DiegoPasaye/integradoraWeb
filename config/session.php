<?php

use Illuminate\Support\Str;

return [

    

    'driver' => env('SESSION_DRIVER', 'file'),



    'lifetime' => env('SESSION_LIFETIME', 120),

    'expire_on_close' => false,

    /*
    |--------------------------------------------------------------------------
    | Session Encryption
    |--------------------------------------------------------------------------
    |
    | This option allows you to easily specify that all of your session data
    | should be encrypted before it is stored. All encryption will be run
    | automatically by Laravel and you can use the Session like normal.
    |
    */

    'encrypt' => false,



    'files' => storage_path('framework/sessions'),

    'connection' => env('SESSION_CONNECTION'),


    'table' => 'sessions',



    'store' => env('SESSION_STORE'),



    'lottery' => [2, 100],


    'cookie' => env(
        'SESSION_COOKIE',
        Str::slug(env('APP_NAME', 'laravel'), '_').'_session'
    ),


    'path' => '/',


    'domain' => env('SESSION_DOMAIN'),



    'secure' => env('SESSION_SECURE_COOKIE'),


    'http_only' => true,


    'same_site' => 'lax',

];
