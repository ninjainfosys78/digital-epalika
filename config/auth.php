<?php


use Modules\Roaster\Entities\TraineeUser;
use App\Models\MobileUser;
use App\Models\User;

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'organization' => [
            'driver' => 'session',
            'provider' => 'organizations',
        ],

        'traineeUser' => [
            'driver' => 'session',
            'provider' => 'traineeUsers',
        ],

        'api' => [
            'driver' => 'passport',
            'provider' => 'users',
        ],

        'mobile-user' => [
            'driver' => 'session',
            'provider' => 'mobile-users',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => User::class,
        ],
        'organizations' => [
            'driver' => 'eloquent',
            'model' => \Modules\EMap\Entities\Organization::class,
        ],

        'traineeUsers' => [
            'driver' => 'eloquent',
            'model' => TraineeUser::class,
          ],
        'mobile-users' => [
            'driver' => 'eloquent',
            'model' => MobileUser::class,
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define the amount of seconds before a password confirmation
    | times out and the user is prompted to re-enter their password via the
    | confirmation screen. By default, the timeout lasts for three hours.
    |
    */

    'password_timeout' => 10800,

];
