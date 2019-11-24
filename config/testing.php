<?php

declare(strict_types=1);

return [
    'user' => [
        'model' => Grocelivery\IdentityProvider\Models\User::class
    ],
    'providers' => [
        Grocelivery\IdentityProvider\Providers\TestingServiceProvider::class
    ],
];
