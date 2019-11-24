<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Testing\Mocks;

use Grocelivery\IdentityProvider\Interfaces\Services\EmailVerifierInterface;
use Grocelivery\IdentityProvider\Models\User;
use Grocelivery\IdentityProvider\Services\Auth\EmailVerifier;

/**
 * Class EmailVerifierMock
 * @package Grocelivery\IdentityProvider\Testing\Mocks
 */
class EmailVerifierMock extends EmailVerifier implements EmailVerifierInterface
{
    /**
     * @param User $user
     */
    public function sendVerificationMail(User $user): void
    {
    }
}
