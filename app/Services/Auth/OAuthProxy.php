<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Services\Auth;

use Exception;
use Grocelivery\CommonUtils\Http\JsonResponse;
use Grocelivery\CommonUtils\Interfaces\JsonResponseInterface;
use Grocelivery\IdentityProvider\Exceptions\InvalidLoginCredentials;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

/**
 * Class OAuthProxy
 * @package Grocelivery\IdentityProvider\Services\Auth
 */
class OAuthProxy
{
    /** @var Application */
    private $app;

    /**
     * OAuthProxy constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @param string $email
     * @param string $password
     * @return JsonResponseInterface
     * @throws Exception
     */
    public function getTokenFromCredentials(string $email, string $password): JsonResponseInterface
    {
        $parameters = [
            'grant_type' => config('auth.oauth.grant_type'),
            'client_id' => config('auth.oauth.client_id'),
            'client_secret' => config('auth.oauth.client_secret'),
            'username' => $email,
            'password' => $password
        ];

        $request = Request::create('/oauth/token', Request::METHOD_POST, $parameters);

        $response = $this->app->handle($request);

        if (!$response->isOk()) {
            throw new InvalidLoginCredentials();
        }

        return JsonResponse::fromJsonString($response->getContent());
    }
}
