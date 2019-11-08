<?php

namespace Grocelivery\IdentityProvider\Http\Requests;

use Grocelivery\IdentityProvider\Exceptions\BadRequestException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

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
    protected function failedValidation(Validator $validator)
    {
        $messages = $validator->getMessageBag()->all();
        throw (new BadRequestException())->setErrors($messages);
    }
}