<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Interfaces\Http\Responses;

use Grocelivery\IdentityProvider\Http\Resources\Resource;
use Illuminate\Http\JsonResponse;

/**
 * Interface ResponseInterface
 * @package Grocelivery\IdentityProvider\Interfaces\Http\Responses
 */
interface ResponseInterface
{
    /**
     * @return array
     */
    public function all(): array;

    /**
     * @param int $code
     * @param string|null $text
     * @return ResponseInterface;
     */
    public function setStatusCode(int $code, $text = null): ResponseInterface;

    /**
     * @param array $body
     * @return ResponseInterface
     */
    public function setBody(array $body): ResponseInterface;
    /**
     * @param string $key
     * @param $value
     * @return ResponseInterface
     */
    public function add(string $key, $value): ResponseInterface;

    /**
     * @param string $key
     * @param Resource $resource
     * @return ResponseInterface
     */
    public function withResource(string $key, Resource $resource): ResponseInterface;

    /**
     * @param array $errors
     * @return ResponseInterface
     */
    public function setErrors(array $errors): ResponseInterface;

    /**
     * @param string $error
     * @return ResponseInterface
     */
    public function addError(string $error): ResponseInterface;

    /**
     * @param string $message
     * @return ResponseInterface
     */
    public function setMessage(string $message): ResponseInterface;

    /**
     * @return string
     */
    public function getMessage(): string;

    /**
     * @return bool
     */
    public function hasMessage(): bool;

    /**
     * @param string $value
     * @return mixed
     */
    public function get(string $value);

    /**
     * @return array
     */
    public function getErrors(): array;

    /**
     * @return int
     */
    public function countErrors(): int;

    /**
     * @return bool
     */
    public function hasErrors(): bool;

    /**
     * @return JsonResponse
     */
    public function send(): JsonResponse;
}
