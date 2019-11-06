<?php

namespace Grocelivery\IdentityProvider\Models\Traits;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

/**
 * Trait UsesUuid
 * @package Grocelivery\IdentityProvider\Models\Traits
 */
trait UsesUuid
{
    protected static function bootUsesUuid(): void
    {
        static::creating(function (Model $model): void {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });
    }

    /**
     * @return bool
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * @return string
     */
    public function getKeyType()
    {
        return 'string';
    }
}