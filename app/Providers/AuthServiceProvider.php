<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Laravel\Passport\RouteRegistrar;

/**
 * Class AuthServiceProvider
 * @package Grocelivery\IdentityProvider\Providers
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $policies = [
        // 'Grocelivery\IdentityProvider\Model' => 'Grocelivery\IdentityProvider\Policies\ModelPolicy',
    ];

    /**
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Passport::routes(function (RouteRegistrar $router): void {
            $router->forAccessTokens();
        });
    }
}
