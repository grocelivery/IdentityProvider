<?php

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
    public function rules()
    {
        return [
            'email' => 'required',
            'password' => 'required',
        ];
    }
}