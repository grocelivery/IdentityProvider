<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Http\Middleware;

use Closure;
use Grocelivery\IdentityProvider\Exceptions\EmailNotVerifiedException;
use Illuminate\Http\Request;

/**
 * Class EnsureEmailIsVerified
 * @package Grocelivery\IdentityProvider\Http\Middleware
 */
class EnsureEmailIsVerified
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws EmailNotVerifiedException
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user() || !$request->user()->hasVerifiedEmail()) {
            throw new EmailNotVerifiedException();
        }

        return $next($request);
    }
}
