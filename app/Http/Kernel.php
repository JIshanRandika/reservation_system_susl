<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
           // \App\Http\Middleware\CustomAuth::class,
        ],

        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'CustomAuth'=> \App\Http\Middleware\CustomAuth::class,
        'AdminMiddleware'=> \App\Http\Middleware\AdminMiddleware::class,
        'VCMiddleware'=> \App\Http\Middleware\VCMiddleware::class,
        'AVUCoordinator'=> \App\Http\Middleware\AVUCoordinator::class,
        'HOD'=> \App\Http\Middleware\HOD::class,
        'DeanHodMiddleware'=> \App\Http\Middleware\DeanHodMiddleware::class,
        'NestCoordinatorMiddleware'=> \App\Http\Middleware\NestCoordinatorMiddleware::class,
        'AgriFarmCoordinatorMiddleware'=> \App\Http\Middleware\AgriFarmCoordinatorMiddleware::class,
        'HrCoordinatorMiddleware' => \App\Http\Middleware\HrCoordinatorMiddleware::class,
        'CareTakerMiddleware'=> \App\Http\Middleware\CareTakerMiddleware::class,
        'HrRegistarMiddleware'=> \App\Http\Middleware\HrRegistarMiddleware::class,
        'NestRegistarMiddleware'=> \App\Http\Middleware\NestRegistarMiddleware::class,
        'ReportGeneratorMiddleware' => \App\Http\Middleware\ReportGeneratorMiddleware::class,
    ];
}
