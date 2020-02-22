<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Services\Auth;

use Exception;
use Grocelivery\IdentityProvider\Interfaces\Services\EmailVerifierInterface;
use Grocelivery\IdentityProvider\Models\User;
use Grocelivery\IdentityProvider\Models\VerificationToken;
use Grocelivery\Utils\Clients\MailerClient;
use Illuminate\Support\Str;

/**
 * Class EmailVerifier
 * @package Grocelivery\IdentityProvider\Services\Auth
 */
class EmailVerifier implements EmailVerifierInterface
{
    /** @var MailerClient */
    protected $mailerClient;

    /**
     * EmailVerifier constructor.
     * @param MailerClient $mailerClient
     */
    public function __construct(MailerClient $mailerClient)
    {
        $this->mailerClient = $mailerClient;
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

        $this->mailerClient->setAccessToken($user->createToken('mailer_personal_token')->accessToken);
        $this->mailerClient->sendMail('emailVerification', $user->email, $data);
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
