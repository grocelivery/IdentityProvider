<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Http\Controllers\Auth;

use Exception;
use Grocelivery\IdentityProvider\Http\Controllers\Controller;
use Grocelivery\Utils\Interfaces\JsonResponseInterface as JsonResponse;
use Illuminate\Http\Request;
use Laravel\Passport\RefreshToken;

/**
 * Class LoginController
 * @package Grocelivery\IdentityProvider\Http\Controllers\Auth
 */
class LogoutController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function logout(Request $request): JsonResponse
    {
        $accessToken = $request->user()->token();

        $refreshTokens = RefreshToken::query()
            ->where('access_token_id', $accessToken->id)
            ->get();

        foreach ($refreshTokens as $refreshToken) {
            $refreshToken->revoke();
        }

        $accessToken->revoke();

        return $this->response->setMessage("Authorization tokens revoked.");
    }
}
