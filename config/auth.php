<?php

return [

    'defaults' => [
        'guard' => 'users',
        'passwords' => 'users',
    ],


    'guards' => [
        // 'web' => [
        //     'driver' => 'session',
        //     'provider' => 'users',
        // ],
        'admins' => [
            'driver' => 'jwt',
            'provider' => 'admins',
        ],
        'users' => [
            'driver' => 'jwt',
            'provider' => 'users',
        ],
    ],


    'providers' => [
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],

        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],


    'password_timeout' => 10800,

];
