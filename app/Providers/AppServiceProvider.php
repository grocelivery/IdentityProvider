<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Providers;

use Grocelivery\IdentityProvider\Interfaces\Services\EmailVerifierInterface;
use Grocelivery\IdentityProvider\Services\Auth\EmailVerifier;
use Grocelivery\Utils\Interfaces\JsonResponseInterface;
use Grocelivery\Utils\Responses\JsonResponse;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 * @package Grocelivery\IdentityProvider\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        $this->app->bind(JsonResponseInterface::class, JsonResponse::class);
        $this->app->bind(EmailVerifierInterface::class, EmailVerifier::class);
    }
}
