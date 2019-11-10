<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Services\Auth;

use Grocelivery\IdentityProvider\Models\User;
use Laravel\Passport\Token;

/**
 * Class AccessTokenManager
 * @package Grocelivery\IdentityProvider\Services\Auth
 */
class AccessTokenManager
{
    /**
     * @param User $user
     */
    public function revokeCurrent(User $user): void
    {
        $user->token()->revoke();
    }

    /**
     * @param User $user
     */
    public function revokeAll(User $user): void
    {
        $user->tokens()->each(function (Token $token): void {
            $token->revoke();
        });
    }
}
