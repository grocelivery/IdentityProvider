<?php

namespace Grocelivery\IdentityProvider\Http\Requests;

/**
 * Class RegisterUser
 * @package Grocelivery\IdentityProvider\Http\Requests
 */
class RegisterUser extends Request
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'passwordConfirmation' => 'required|same:password',
        ];
    }
}