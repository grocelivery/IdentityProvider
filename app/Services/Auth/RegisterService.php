<?php

namespace Grocelivery\IdentityProvider\Services\Auth;

use Grocelivery\IdentityProvider\Models\ActivationToken;
use Grocelivery\IdentityProvider\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Class RegisterService
 * @package Grocelivery\IdentityProvider\Services\Auth
 */
class RegisterService
{
    /** @var AccountActivationService */
    private $accountActivationService;

    /**
     * RegisterService constructor.
     * @param AccountActivationService $accountActivationService
     */
    public function __construct(AccountActivationService $accountActivationService)
    {
        $this->accountActivationService = $accountActivationService;
    }

    /**
     * @param string $email
     * @param $password
     * @return User
     */
    public function registerUser(string $email, $password): User
    {
        $user = new User();
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->generateNameFromEmail();
        $user->save();

        $this->accountActivationService->sendActivationMail($user);

        return $user;
    }

    /**
     * @param User $user
     */
    protected function sendActivationMail(User $user): void
    {
        $activationToken = new ActivationToken();
        $activationToken->user_id = $user->id;
        $activationToken->token = Str::random(ActivationToken::LENGTH);
        $activationToken->save();
    }
}