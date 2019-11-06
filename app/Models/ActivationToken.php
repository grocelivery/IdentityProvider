<?php

namespace Grocelivery\IdentityProvider\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ActivationToken
 * @package Grocelivery\IdentityProvider\Models
 * @property string $id
 * @property string $user_id
 * @property string $token
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class ActivationToken extends Model
{
    /** @var int */
    public const LENGTH = 32;
}
