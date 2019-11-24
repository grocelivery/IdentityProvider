<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Http\Requests;

use Grocelivery\Utils\Requests\FormRequest;

/**
 * Class LoginUser
 * @package Grocelivery\IdentityProvider\Http\Requests
 */
class LoginUser extends FormRequest
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
