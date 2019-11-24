<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Exceptions;

use Grocelivery\Utils\Exceptions\InternalServerException;
use Illuminate\Http\Response;

/**
 * Class EmailNotVerifiedException
 * @package Grocelivery\IdentityProvider\Exceptions
 */
class EmailNotVerifiedException extends InternalServerException
{
    /** @var string */
    protected $message = "Email address is not verified.";
    /** @var int */
    protected $code = Response::HTTP_FORBIDDEN;
}
