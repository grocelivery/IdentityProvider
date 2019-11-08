<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Tests\Traits;

use Grocelivery\IdentityProvider\Http\Kernel;
use Grocelivery\IdentityProvider\Providers\TestingServiceProvider;
use Illuminate\Console\Command;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Facade;
use Illuminate\Foundation\Bootstrap\LoadConfiguration;
use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;

/**
 * Trait InitializesApplication
 * @package Grocelivery\IdentityProvider\Tests\Traits
 */
trait InitializesApplication
{
    /** @var Application */
    protected $app;

    /**
     * @Given initialized application
     */
    public function initializedApplication(): void
    {
        $this->app = require __DIR__ . '/../../../bootstrap/app.php';
        $this->app->loadEnvironmentFrom('.env.testing');
        (new LoadEnvironmentVariables())->bootstrap($this->app);
        (new LoadConfiguration())->bootstrap($this->app);

        Facade::setFacadeApplication($this->app);

        $this->refreshDatabase();

        $this->app->register(TestingServiceProvider::class);
    }

    private function refreshDatabase(): void
    {
        Artisan::call('migrate:fresh');
    }
}
