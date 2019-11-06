<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Tests\Contexts;

use Behat\Behat\Context\Context;
use Grocelivery\IdentityProvider\Tests\Traits\AuthenticatesUsers;
use Grocelivery\IdentityProvider\Tests\Traits\InitializesApplication;
use Grocelivery\IdentityProvider\Tests\Traits\SendsRequests;

/**
 * Class FeatureContext
 * @package Grocelivery\IdentityProvider\Tests\Contexts
 */
class FeatureContext implements Context
{
    use InitializesApplication, SendsRequests, AuthenticatesUsers;
}
