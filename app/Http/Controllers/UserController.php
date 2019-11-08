<?php

namespace Grocelivery\IdentityProvider\Http\Controllers;

use Grocelivery\IdentityProvider\Http\Requests\Request;
use Grocelivery\IdentityProvider\Http\Resources\UserResource;
use Grocelivery\IdentityProvider\Interfaces\Http\Responses\ResponseInterface as Response;

/**
 * Class UserController
 * @package Grocelivery\IdentityProvider\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function getAuthenticatedUser(Request $request): Response
    {
        return $this->response->withResource('user', new UserResource($request->user()));
    }
}