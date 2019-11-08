<?php

namespace Grocelivery\IdentityProvider\Tests\Mocks;

use Grocelivery\IdentityProvider\Http\Responses\Response;
use Grocelivery\IdentityProvider\Interfaces\Http\Clients\OAuthClientInterface;
use Grocelivery\IdentityProvider\Interfaces\Http\Responses\ResponseInterface;

/**
 * Class OAuthClient
 * @package Grocelivery\IdentityProvider\Tests\Mocks
 */
class OAuthClient implements OAuthClientInterface
{
    /**
     * @param string $email
     * @param string $password
     * @return ResponseInterface
     */
    public function retrieveAccessToken(string $email, string $password): ResponseInterface
    {
        return Response::fromArray([
            "token_type" => "Bearer",
            "expires_in" => 31622400,
            "access_token" => "",
            "refresh_token" => "",
        ]);
    }
}