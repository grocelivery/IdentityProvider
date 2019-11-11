<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class VerificationToken
 * @package Grocelivery\IdentityProvider\Models
 * @property string $id
 * @property string $user_id
 * @property User $user
 * @property string $token
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class VerificationToken extends Model
{
    /** @var int */
    public const LENGTH = 32;

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'token';
    }
}
