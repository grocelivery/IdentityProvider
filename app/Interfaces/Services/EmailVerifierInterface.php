<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Interfaces\Services;

use Grocelivery\IdentityProvider\Models\User;
use Grocelivery\IdentityProvider\Models\VerificationToken;

/**
 * Interface EmailVerifierInterface
 * @package Grocelivery\IdentityProvider\Interfaces\Services
 */
interface EmailVerifierInterface
{
    /**
     * @param User $user
     */
    public function sendVerificationMail(User $user): void;

    /**
     * @param VerificationToken $token
     */
    public function verify(VerificationToken $token): void;

    /**
     * @param string $email
     * @return bool
     */
    public function isEmailVerified(string $email): bool;
}
