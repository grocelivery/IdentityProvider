<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Services\Auth;

use Exception;
use Grocelivery\IdentityProvider\Interfaces\Services\EmailVerifierInterface as EmailVerifier;
use Grocelivery\IdentityProvider\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserRegistrar
 * @package Grocelivery\IdentityProvider\Services\Auth
 */
class UserRegistrar
{
    /** @var EmailVerifier */
    protected $emailVerifier;

    /**
     * UserRegistrar constructor.
     * @param EmailVerifier $emailVerifier
     */
    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    /**
     * @param string $email
     * @param string $password
     * @return User
     * @throws Exception
     */
    public function register(string $email, string $password): User
    {
        DB::beginTransaction();

        $user = new User();
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->generateNameFromEmail();
        $user->save();

        $this->emailVerifier->sendVerificationMail($user);

        DB::commit();

        return $user;
    }
}
