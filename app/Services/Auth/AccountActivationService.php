<?php

namespace Grocelivery\IdentityProvider\Services\Auth;

use Grocelivery\IdentityProvider\Models\ActivationToken;
use Grocelivery\IdentityProvider\Models\User;
use Illuminate\Support\Str;

class AccountActivationService
{
    public function sendActivationMail(User $user): void
    {
        $activationToken = $this->generateActivationToken($user);
    }

    public function activateAccount(User $user): void
    {

    }

    protected function generateActivationToken(User $user): string
    {
        $activationToken = new ActivationToken();
        $activationToken->user_id = $user->id;
        $activationToken->token = Str::random(ActivationToken::LENGTH);
        $activationToken->save();

        return $activationToken->token;
    }
}