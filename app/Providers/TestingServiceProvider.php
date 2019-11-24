<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Providers;

use Grocelivery\IdentityProvider\Interfaces\Services\EmailVerifierInterface;
use Grocelivery\IdentityProvider\Testing\Mocks\EmailVerifierMock;
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
        $this->app->bind(EmailVerifierInterface::class, EmailVerifierMock::class);
    }
}
