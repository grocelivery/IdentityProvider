<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Providers;

use Grocelivery\IdentityProvider\Http\Responses\Response;
use Illuminate\Support\Facades\Schema;
use Grocelivery\IdentityProvider\Interfaces\Http\Responses\ResponseInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        $this->app->bind(ResponseInterface::class, Response::class);
    }
}
