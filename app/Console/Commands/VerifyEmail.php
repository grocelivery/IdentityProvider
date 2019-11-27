<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Console\Commands;

use Grocelivery\IdentityProvider\Models\User;
use Illuminate\Console\Command;

/**
 * Class VerifyEmail
 * @package Grocelivery\IdentityProvider\Console\Commands
 */
class VerifyEmail extends Command
{
    /** @var string */
    protected $signature = 'email:verify {email}';

    /** @var string */
    protected $description = 'Verifies user\'s email';

    public function handle(): void
    {
        /** @var User $user */
        $user = User::whereEmail($this->argument('email'))->firstOrFail();
        $user->markEmailAsVerified();

        $this->info('Email marked as verified.');
    }
}
