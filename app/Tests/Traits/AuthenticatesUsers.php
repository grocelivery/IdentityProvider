<?php

namespace Grocelivery\IdentityProvider\Tests\Traits;

use Grocelivery\IdentityProvider\Models\User;
use Grocelivery\IdentityProvider\Services\Auth\RegisterService;

/**
 * Trait AuthenticatesUsers
 * @package Grocelivery\IdentityProvider\Tests\Traits
 */
trait AuthenticatesUsers
{
    /** @var string */
    protected $accessToken;

    /**
     * @Given user with :email email and :password password is registered
     * @param string $email
     * @param string $password
     */
    public function userWithAndPasswordIsRegistered(string $email, string $password)
    {
        $authService = new RegisterService();
        $authService->registerUser($email, $password);
    }

    /**
     * @Given user :email has activation token :activationToken
     * @param string $email
     * @param string $activationToken
     */
    public function userHasActivationToken(string $email, string $activationToken)
    {
        $user = User::query()->firstOrFail(['email' => $email]);

        $activationToken = new ActivationToken();
        $activationToken->user_id = $user->id;
        $activationToken->token = $activationToken;
        $activationToken->save();
    }
}