<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Http\Controllers\Auth;

use Grocelivery\IdentityProvider\Http\Controllers\Controller;
use Grocelivery\IdentityProvider\Http\Requests\Request;
use Grocelivery\IdentityProvider\Interfaces\Http\Responses\ResponseInterface as Response;
use Grocelivery\IdentityProvider\Services\Auth\AccessTokenManager;

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
     * @param Response $response
     * @param AccessTokenManager $accessTokenManager
     */
    public function __construct(Response $response, AccessTokenManager $accessTokenManager)
    {
        parent::__construct($response);
        $this->accessTokenManager = $accessTokenManager;
    }

    /**
     * @return Response
     */
    public function validate(): Response
    {
        return $this->response->setMessage('Access token validated.');
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function revokeCurrent(Request $request): Response
    {
        $this->accessTokenManager->revokeCurrent($request->user());

        return $this->response->setMessage('Current access token revoked.');
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function revokeAll(Request $request): Response
    {
        $this->accessTokenManager->revokeAll($request->user());

        return $this->response->setMessage('All user\'s access tokens revoked.');
    }
}
