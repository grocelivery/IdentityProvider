<?php

namespace Grocelivery\IdentityProvider\Interfaces\Http\Clients;

use Grocelivery\IdentityProvider\Interfaces\Http\Responses\ResponseInterface;

/**
 * Interface OAuthClientInterface
 * @package Grocelivery\IdentityProvider\Interfaces\Http\Clients
 */
interface OAuthClientInterface
{
    /**
     * @param string $email
     * @param string $password
     * @return ResponseInterface
     */
    public function retrieveAccessToken(string $email, string $password): ResponseInterface;
}