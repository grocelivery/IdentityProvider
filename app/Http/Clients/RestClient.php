<?php

namespace Grocelivery\IdentityProvider\Http\Clients;

use Grocelivery\IdentityProvider\Http\Responses\Response;
use Grocelivery\IdentityProvider\Interfaces\Http\Responses\ResponseInterface;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

/**
 * Class RestClient
 * @package Grocelivery\IdentityProvider\Http\Clients
 */
class RestClient extends Client
{
    /** @var array */
    protected $options = [];

    /**
     * @param $method
     * @param string $uri
     * @param array $options
     * @return ResponseInterface
     */
    public function request($method, $uri = "", array $options = []): ResponseInterface
    {
        $data = $this->requestAsync($method, $uri, $this->options)->wait();
        return Response::fromJsonString($data->getBody()->getContents());
    }

    /**
     * @param array $headers
     */
    protected function setHeaders(array $headers): void
    {
        $this->options['headers'] = $headers;
    }

    /**
     * @param array $json
     */
    protected function setJson(array $json): void
    {
        $this->options['json'] = $json;
    }

    /**
     * @param bool $isSynchronous
     */
    protected function setIsSynchronous(bool $isSynchronous): void
    {
        $this->options[RequestOptions::SYNCHRONOUS] = $isSynchronous;
    }
}