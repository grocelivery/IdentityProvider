<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Services\Auth;

use Exception;
use Grocelivery\IdentityProvider\Interfaces\Services\EmailVerifierInterface;
use Grocelivery\IdentityProvider\Models\User;
use Grocelivery\IdentityProvider\Models\VerificationToken;
use Grocelivery\Utils\Clients\NotifierClient;
use Illuminate\Support\Str;

/**
 * Class EmailVerifier
 * @package Grocelivery\IdentityProvider\Services\Auth
 */
class EmailVerifier implements EmailVerifierInterface
{
    /** @var NotifierClient */
    protected $notifierClient;

    /**
     * EmailVerifier constructor.
     * @param NotifierClient $notifierClient
     */
    public function __construct(NotifierClient $notifierClient)
    {
        $this->notifierClient = $notifierClient;
    }

    /**
     * @param User $user
     * @throws Exception
     */
    public function sendVerificationMail(User $user): void
    {
        $activationToken = $this->generateVerificationToken($user);

        $data = [
            'name' => $user->name,
            'token' => $activationToken,
        ];

        $this->notifierClient->setAccessToken($user->createToken('notifier_personal_token')->accessToken);
        $this->notifierClient->sendMail('emailVerification', $user->email, $data);
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
