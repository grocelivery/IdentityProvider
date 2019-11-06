<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Tests\Traits;

use Illuminate\Foundation\Application;

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
    }
}
