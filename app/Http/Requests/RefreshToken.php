<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Http\Requests;

use Grocelivery\Utils\Requests\FormRequest;

/**
 * Class RefreshToken
 * @package Grocelivery\IdentityProvider\Http\Requests
 */
class RefreshToken extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'refreshToken' => 'required|string',
        ];
    }
}
