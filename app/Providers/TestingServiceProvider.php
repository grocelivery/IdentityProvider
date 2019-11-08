<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Providers;

use Grocelivery\IdentityProvider\Interfaces\Http\Clients\OAuthClientInterface;
use Grocelivery\IdentityProvider\Tests\Mocks\OAuthClient;
use Illuminate\Support\ServiceProvider;

/**
 * Class TestingServiceProvider
 * @package Grocelivery\IdentityProvider\Providers
 */
class TestingServiceProvider extends ServiceProvider
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
        $this->app->bind(OAuthClientInterface::class, OAuthClient::class);
    }
}
