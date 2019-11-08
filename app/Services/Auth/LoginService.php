<?php

namespace Grocelivery\IdentityProvider\Services\Auth;

use Grocelivery\IdentityProvider\Interfaces\Http\Clients\OAuthClientInterface;

/**
 * Class LoginService
 * @package Grocelivery\IdentityProvider\Services\Auth
 */
class LoginService
{
    /** @var OAuthClientInterface */
    private $client;

    /**
     * LoginService constructor.
     * @param OAuthClientInterface $client
     */
    public function __construct(OAuthClientInterface $client)
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