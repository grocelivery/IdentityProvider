<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Http\Responses;

use Grocelivery\IdentityProvider\Http\Resources\Resource;
use Grocelivery\IdentityProvider\Interfaces\Http\Responses\ResponseInterface;
use Illuminate\Http\JsonResponse;

/**
 * Class Response
 * @package Grocelivery\IdentityProvider\Http\Responses
 */
class Response extends JsonResponse implements ResponseInterface
{
    /** @var array */
    private $body = [];
    /** @var array */
    private $errors = [];

    /**
     * @param null $data
     * @param int $status
     * @param array $headers
     * @return ResponseInterface
     */
    public static function fromJsonString($data = null, $status = 200, $headers = []): ResponseInterface
    {
        $data = json_decode($data, true);
        $response = new Response($data, $status, $headers);
        $response->setBody($data);
        return $response;
    }

    /**
     * @param array $data
     * @return ResponseInterface
     */
    public static function fromArray(array $data): ResponseInterface
    {
        return static::fromJsonString(json_encode($data));
    }

    /**
     * @return array
     */
    public function all(): array
    {
        if (!empty($this->body)) {
            $data['body'] = $this->body;
        }

        $data['errors'] = $this->errors;

        return $data;
    }

    /**
     * @param int $code
     * @param null $text
     * @return ResponseInterface
     */
    public function setStatusCode(int $code, $text = null): ResponseInterface
    {
        parent::setStatusCode($code, $text);
        return $this;
    }

    /**
     * @return array
     */
    public function getBody(): array
    {
        return $this->body;
    }

    /**
     * @param array $body
     * @return ResponseInterface
     */
    public function setBody(array $body): ResponseInterface
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @param string $key
     * @param $value
     * @return ResponseInterface
     */
    public function add(string $key, $value): ResponseInterface
    {
        $this->body[$key] = $value;
        return $this;
    }

    /**
     * @param string $key
     * @param Resource $resource
     * @return ResponseInterface
     */
    public function withResource(string $key, Resource $resource): ResponseInterface
    {
        $this->body[$key] = $resource->map();
        return $this;
    }

    /**
     * @param string $message
     * @return ResponseInterface
     */
    public function setMessage(string $message): ResponseInterface
    {
        $this->body['message'] = $message;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->body['message'];
    }

    /**
     * @return bool
     */
    public function hasMessage(): bool
    {
        return !empty($this->body['message']);
    }

    /**
     * @param array $errors
     * @return ResponseInterface
     */
    public function setErrors(array $errors): ResponseInterface
    {
        $this->errors = $errors;
        return $this;
    }

    /**
     * @param string $error
     * @return ResponseInterface
     */
    public function addError(string $error): ResponseInterface
    {
        $this->errors[] = $error;
        return $this;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key)
    {
        return $this->body[$key];
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @return int
     */
    public function countErrors(): int
    {
        return count($this->getErrors());
    }

    /**
     * @return bool
     */
    public function hasErrors(): bool
    {
        return $this->countErrors() !== 0;
    }

    /**
     * @return JsonResponse
     */
    public function send(): JsonResponse
    {
        $this->prepareData();
        return parent::send();
    }

    /**
     *
     */
    protected function prepareData(): void
    {
        $this->data = json_encode($this->all(), $this->encodingOptions);
        $this->update();
    }
}
