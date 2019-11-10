<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

/**
 * Class Kernel
 * @package Grocelivery\IdentityProvider\Http
 */
class Kernel extends HttpKernel
{
    /** @var array */
    protected $middleware = [
        \Grocelivery\IdentityProvider\Http\Middleware\TrustProxies::class,
        \Grocelivery\IdentityProvider\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \Grocelivery\IdentityProvider\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /** @var array */
    protected $middlewareGroups = [
        'api' => [
            'throttle:60,1',
            'bindings',
        ],
        'auth:api' => [
            'auth',
            'verified',
        ],
    ];

    /** @var array */
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Grocelivery\IdentityProvider\Http\Middleware\EnsureEmailIsVerified::class,
    ];

    /** @var array */
    protected $middlewarePriority = [
        \Illuminate\Auth\Middleware\Authorize::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \Illuminate\Auth\Middleware\Authenticate::class,
        \Illuminate\Routing\Middleware\ThrottleRequests::class,
        \Illuminate\Session\Middleware\AuthenticateSession::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        \Illuminate\Auth\Middleware\Authorize::class,
    ];
}
