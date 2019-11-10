<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Tests\Traits;

use Carbon\Carbon;
use Grocelivery\IdentityProvider\Providers\TestingServiceProvider;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Bootstrap\LoadConfiguration;
use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;

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
        $this->createOAuthClient();

        $this->app->register(TestingServiceProvider::class);
    }

    protected function refreshDatabase(): void
    {
        Artisan::call('migrate:fresh');
    }

    protected function createOAuthClient(): void
    {
        DB::table('oauth_clients')->insert([
            'id' => config('auth.oauth.client_id'),
            'name' => 'Test OAuth Client',
            'secret' => config('auth.oauth.client_secret'),
            'redirect' => 'http://localhost',
            'revoked' => false,
            'personal_access_client' => false,
            'password_client' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
