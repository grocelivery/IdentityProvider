<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Providers;

use Grocelivery\HttpUtils\Interfaces\JsonResponseInterface;
use Grocelivery\HttpUtils\Responses\JsonResponse;
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
    }
}
