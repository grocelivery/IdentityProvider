<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Laravel\Passport\RouteRegistrar;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'Grocelivery\IdentityProvider\Model' => 'Grocelivery\IdentityProvider\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Passport::routes(function (RouteRegistrar $router) {
            $router->forAccessTokens();
        });
    }
}
