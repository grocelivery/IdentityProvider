<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Interfaces\Exceptions;

/**
 * Interface ResponseExceptionInterface
 * @package Grocelivery\IdentityProvider\Interfaces\Exceptions
 */
interface ResponseExceptionInterface
{
    /**
     * @return array
     */
    public function getErrors(): array;

    /**
     * @param array $errors
     * @return ResponseExceptionInterface
     */
    public function setErrors(array $errors): ResponseExceptionInterface;

    /**
     * @param string $error
     * @return ResponseExceptionInterface
     */
    public function addError(string $error): ResponseExceptionInterface;

    /**
     * @param string $message
     * @return ResponseExceptionInterface
     */
    public function setMessage(string $message): ResponseExceptionInterface;
}
