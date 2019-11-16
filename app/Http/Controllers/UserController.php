<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Http\Controllers;

use Grocelivery\HttpUtils\Interfaces\JsonResponseInterface as JsonResponse;
use Grocelivery\IdentityProvider\Http\Requests\Request;
use Grocelivery\IdentityProvider\Http\Resources\UserResource;

/**
 * Class UserController
 * @package Grocelivery\IdentityProvider\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getAuthenticatedUser(Request $request): JsonResponse
    {
        return $this->response->withResource('user', new UserResource($request->user()));
    }
}
