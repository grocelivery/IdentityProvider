<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Exceptions;

use Illuminate\Http\Response;

/**
 * Class BadRequestException
 * @package Grocelivery\IdentityProvider\Exceptions
 */
class BadRequestException extends InternalServerException
{
    /** @var string */
    protected $message = "Bad request.";
    /** @var int */
    protected $code = Response::HTTP_BAD_REQUEST;
}
