<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

/**
 * Class RouteServiceProvider
 * @package Grocelivery\IdentityProvider\Providers
 */
class RouteServiceProvider extends ServiceProvider
{
    /** @var string */
    protected $namespace = 'Grocelivery\IdentityProvider\Http\Controllers';

    /**
     * @return void
     */
    public function boot(): void
    {
        parent::boot();
    }

    /**
     * @return void
     */
    public function map(): void
    {
        $this->mapApiRoutes();
    }

    /**
     * @return void
     */
    protected function mapApiRoutes(): void
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
