<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Models;

use Carbon\Carbon;
use Grocelivery\IdentityProvider\Models\Traits\UsesUuid;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Str;

/**
 * Class User
 * @package Grocelivery\IdentityProvider\Models
 * @property string $id
 * @property string $email
 * @property string $name
 * @property string $password
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class User extends Authenticatable
{
    use UsesUuid, HasApiTokens, Notifiable;

    /** @var array */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /** @var array */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /** @var array */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function generateNameFromEmail(): void
    {
        $this->name = head(explode("@", $this->email));
    }
}
