<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Interfaces\Services;

use Grocelivery\IdentityProvider\Models\User;
use Grocelivery\IdentityProvider\Models\VerificationToken;
use Grocelivery\Utils\Clients\NotifierClient;

/**
 * Interface EmailVerifierInterface
 * @package Grocelivery\IdentityProvider\Interfaces\Services
 */
interface EmailVerifierInterface
{
    /**
     * EmailVerifier constructor.
     * @param NotifierClient $notifierClient
     */
    public function __construct(NotifierClient $notifierClient);

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
