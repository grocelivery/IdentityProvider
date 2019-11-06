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
            'grant_type' => 'password',
            'client_id' => 2,
            'client_secret' => '1wd73LcwvmEytv6yDToBfGXD290UylDEp0gYIg8s',
            'username' => $email,
            'password' => $password
        ]);

        /** @var ResponseInterface $response */
        $response = $this->post(config('app.url') . '/oauth/token');
        return $response;
    }
}