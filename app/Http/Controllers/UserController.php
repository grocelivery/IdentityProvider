<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Http\Controllers;

use Grocelivery\IdentityProvider\Http\Resources\UserResource;
use Grocelivery\Utils\Interfaces\JsonResponseInterface as JsonResponse;
use Illuminate\Http\Request;

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
