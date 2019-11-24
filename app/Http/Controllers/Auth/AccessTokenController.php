<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Http\Controllers\Auth;

use Grocelivery\IdentityProvider\Http\Controllers\Controller;
use Grocelivery\IdentityProvider\Services\Auth\AccessTokenManager;
use Grocelivery\Utils\Interfaces\JsonResponseInterface as JsonResponse;
use Illuminate\Http\Request;

/**
 * Class AccessTokenController
 * @package Grocelivery\IdentityProvider\Http\Controllers\Auth
 */
class AccessTokenController extends Controller
{
    /** @var AccessTokenManager */
    protected $accessTokenManager;

    /**
     * AccessTokenController constructor.
     * @param JsonResponse $response
     * @param AccessTokenManager $accessTokenManager
     */
    public function __construct(JsonResponse $response, AccessTokenManager $accessTokenManager)
    {
        parent::__construct($response);
        $this->accessTokenManager = $accessTokenManager;
    }

    /**
     * @return JsonResponse
     */
    public function validate(): JsonResponse
    {
        return $this->response->setMessage('Access token validated.');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function revokeCurrent(Request $request): JsonResponse
    {
        $this->accessTokenManager->revokeCurrent($request->user());

        return $this->response->setMessage('Current access token revoked.');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function revokeAll(Request $request): JsonResponse
    {
        $this->accessTokenManager->revokeAll($request->user());

        return $this->response->setMessage('All user\'s access tokens revoked.');
    }
}
