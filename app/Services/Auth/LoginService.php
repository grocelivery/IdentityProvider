<?php

namespace Grocelivery\IdentityProvider\Services\Auth;

use Grocelivery\IdentityProvider\Http\Clients\OAuthClient;

/**
 * Class LoginService
 * @package Grocelivery\IdentityProvider\Services\Auth
 */
class LoginService
{
    /** @var OAuthClient */
    private $client;

    /**
     * LoginService constructor.
     * @param OAuthClient $client
     */
    public function __construct(OAuthClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $email
     * @param string $password
     * @return string
     */
    public function loginUser(string $email, string $password): string
    {
        $response = $this->client->retrieveAccessToken($email, $password);
        return $response->get('access_token');
    }
}