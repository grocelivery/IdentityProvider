<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Tests\Traits;

use Grocelivery\IdentityProvider\Models\User;
use Grocelivery\IdentityProvider\Models\VerificationToken;
use Grocelivery\IdentityProvider\Services\Auth\UserRegistrar;
use Illuminate\Contracts\Container\BindingResolutionException;
use Laravel\Passport\Passport;

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
     * @throws BindingResolutionException
     */
    public function userWithAndPasswordIsRegistered(string $email, string $password): void
    {
        $userRegistrar = app()->make(UserRegistrar::class);
        $userRegistrar->register($email, $password);
    }

    /**
     * @Given :token verification token exists for :email email
     * @param string $token
     * @param string $email
     */
    public function userHasActivationToken(string $token, string $email): void
    {
        $user = User::findByEmail($email);

        $activationToken = new VerificationToken();
        $activationToken->user_id = $user->id;
        $activationToken->token = $token;
        $activationToken->save();
    }

    /**
     * @Given :email email is verified
     * @param string $email
     */
    public function emailIsVerified(string $email): void
    {
        User::findByEmail($email)->markEmailAsVerified();
    }

    /**
     * @Given user with :email email is authenticated
     * @param $email
     */
    public function userWithEmailIsAuthenticated(string $email): void
    {
        Passport::actingAs(User::findByEmail($email));
    }
}
