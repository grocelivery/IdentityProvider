<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Http\Requests;

/**
 * Class LoginUser
 * @package Grocelivery\IdentityProvider\Http\Requests
 */
class LoginUser extends Request
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required',
            'password' => 'required',
        ];
    }
}
