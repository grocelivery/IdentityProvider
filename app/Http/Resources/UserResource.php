<?php

namespace Grocelivery\IdentityProvider\Http\Resources;

use Grocelivery\IdentityProvider\Models\User;

class UserResource extends Resource
{
    public function toArray(): array
    {
        /** @var User $user */
        $user = $this->resource;

        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'active' => $user->hasVerifiedEmail(),
            'createdAt' => $user->created_at->toDateTimeString(),
        ];
    }
}