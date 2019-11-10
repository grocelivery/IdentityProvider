<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Services\Auth;

use Exception;
use Grocelivery\IdentityProvider\Models\User;
use Grocelivery\IdentityProvider\Models\VerificationToken;
use Illuminate\Support\Str;

/**
 * Class EmailVerifier
 * @package Grocelivery\IdentityProvider\Services\Auth
 */
class EmailVerifier
{
    /**
     * @param User $user
     */
    public function sendVerificationMail(User $user): void
    {
        $activationToken = $this->generateVerificationToken($user);
    }

    /**
     * @param VerificationToken $token
     * @throws Exception
     */
    public function verify(VerificationToken $token): void
    {
        $user = $token->user;

        $user->markEmailAsVerified();
        $token->delete();
    }

    /**
     * @param string $email
     * @return bool
     */
    public function isEmailVerified(string $email): bool
    {
        return User::findByEmail($email)->hasVerifiedEmail();
    }

    /**
     * @param User $user
     * @return string
     */
    protected function generateVerificationToken(User $user): string
    {
        $user->verificationToken()->delete();

        $activationToken = new VerificationToken();
        $activationToken->user_id = $user->id;
        $activationToken->token = Str::random(VerificationToken::LENGTH);
        $activationToken->save();

        return $activationToken->token;
    }
}
