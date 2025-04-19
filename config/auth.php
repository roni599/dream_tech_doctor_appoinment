<?php

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
        'guard' => 'api',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Here you may define every authentication guard for your application.
    | A great default configuration has been defined for you here using
    | session storage and the Eloquent user provider.
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved from your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | Supported drivers: "session", "token", "jwt"
    |
    */

    'guards' => [
        'api' => [
            'driver' => 'jwt',
            'provider' => 'users',
        ],

        // Guard for API-based authentication for users (JWT)
        'user_api' => [
            'driver' => 'jwt',
            'provider' => 'users',
        ],

        // Guard for API-based authentication for doctors (JWT)
        'doctor_api' => [
            'driver' => 'jwt',
            'provider' => 'doctors',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | If you have multiple user tables or models, configure multiple sources.
    | Each source may then be assigned to a guard to define its behavior.
    |
    */

    'providers' => [
        // Default user provider using Eloquent
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        // Doctor provider using Eloquent
        'doctors' => [
            'driver' => 'eloquent',
            'model' => App\Models\Doctor::class,
        ],

        // Example for using database directly:
        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have more
    | than one user table or model in the application. Separate configurations
    | can be created for users and doctors with different settings.
    |
    | The expire time is the number of minutes that each reset token remains
    | valid. The throttle helps prevent excessive requests.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'doctors' => [
            'provider' => 'doctors',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | This defines how long (in seconds) before a password confirmation
    | times out and the user is prompted to re-enter their password.
    | The default timeout lasts for three hours.
    |
    */

    'password_timeout' => 10800,

];
