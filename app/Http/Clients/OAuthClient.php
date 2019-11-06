<?php

namespace Grocelivery\IdentityProvider\Http\Clients;

use Grocelivery\IdentityProvider\Interfaces\Http\Responses\ResponseInterface;

/**
 * Class OAuthClient
 * @package Grocelivery\IdentityProvider\Http\Clients
 */
class OAuthClient extends RestClient
{
    /**
     * @param string $email
     * @param string $password
     * @return ResponseInterface
     */
    public function retrieveAccessToken(string $email, string $password): ResponseInterface
    {
        $this->setJson([
            'grant_type' => config('auth.oauth.grant_type'),
            'client_id' => config('auth.oauth.client_id'),
            'client_secret' => config('auth.oauth.client_secret'),
            'username' => $email,
            'password' => $password
        ]);

        /** @var ResponseInterface $response */
        $response = $this->post(config('app.url') . '/oauth/token');
        return $response;
    }
}