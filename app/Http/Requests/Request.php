<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Http\Requests;

use Grocelivery\CommonUtils\Exceptions\BadRequestException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class Request
 * @package Grocelivery\IdentityProvider\Http\Requests
 */
class Request extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator): void
    {
        $messages = $validator->getMessageBag()->all();
        throw (new BadRequestException())->setErrors($messages);
    }
}
