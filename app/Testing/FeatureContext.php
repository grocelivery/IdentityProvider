<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Testing;

use Grocelivery\IdentityProvider\Models\VerificationToken;
use Grocelivery\Testing\Laravel\Contexts\FeatureContext as BaseContext;

/**
 * Class FeatureContext
 * @package Grocelivery\IdentityProvider\Testing
 */
class FeatureContext extends BaseContext
{
    /**
     * @Given :token verification token exists for :email email
     * @param string $token
     * @param string $email
     */
    public function userHasActivationToken(string $token, string $email): void
    {
        $user = $this->getUserModelClass()::whereEmail($email)->first();

        $activationToken = new VerificationToken();
        $activationToken->user_id = $user->id;
        $activationToken->token = $token;
        $activationToken->save();
    }
}
