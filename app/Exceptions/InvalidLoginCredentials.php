<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Exceptions;

use Grocelivery\HttpUtils\Exceptions\BadRequestException;

/**
 * Class InvalidLoginCredentials
 * @package Grocelivery\IdentityProvider\Exceptions
 */
class InvalidLoginCredentials extends BadRequestException
{
    /** @var string */
    protected $message = "Invalid login credentials.";
}
