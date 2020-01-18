<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Http\Controllers\Auth;

use Grocelivery\IdentityProvider\Http\Controllers\Controller;
use Grocelivery\IdentityProvider\Http\Requests\RefreshToken;
use Grocelivery\IdentityProvider\Services\Auth\OAuthProxy;
use Grocelivery\Utils\Interfaces\JsonResponseInterface as JsonResponse;

/**
 * Class RefreshTokenController
 * @package Grocelivery\IdentityProvider\Http\Controllers\Auth
 */
class RefreshTokenController extends Controller
{
    /** @var OAuthProxy */
    protected $oAuthProxy;

    /**
     * RefreshTokenController constructor.
     * @param JsonResponse $response
     * @param OAuthProxy $oAuthProxy
     */
    public function __construct(JsonResponse $response, OAuthProxy $oAuthProxy)
    {
        parent::__construct($response);
        $this->oAuthProxy = $oAuthProxy;
    }

    public function refresh(RefreshToken $request): JsonResponse
    {
        $authResponse = $this->oAuthProxy->refreshToken($request->input("refreshToken"));

        return $this->response
            ->add('accessToken', $authResponse->get('access_token'))
            ->add('refreshToken', $authResponse->get('refresh_token'));
    }
}
