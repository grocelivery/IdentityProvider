<?php

namespace Grocelivery\IdentityProvider\Http\Controllers\Auth;

use Exception;
use Grocelivery\IdentityProvider\Http\Controllers\Controller;
use Grocelivery\IdentityProvider\Http\Resources\UserResource;
use Grocelivery\IdentityProvider\Interfaces\Http\Responses\ResponseInterface as Response;
use Grocelivery\IdentityProvider\Models\ActivationToken;

/**
 * Class AccountActivationController
 * @package Grocelivery\IdentityProvider\Http\Controllers\Auth
 */
class AccountActivationController extends Controller
{
    /**
     * @param ActivationToken $token
     * @return Response
     * @throws Exception
     */
    public function activate(ActivationToken $token): Response
    {
        $user = $token->user;
        $user->markEmailAsVerified();

        $token->delete();

        return $this->response->withResource('user', new UserResource($user));
    }
}