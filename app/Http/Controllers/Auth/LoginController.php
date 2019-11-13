<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Http\Controllers\Auth;

use Exception;
use Grocelivery\CommonUtils\Interfaces\JsonResponseInterface as JsonResponse;
use Grocelivery\IdentityProvider\Exceptions\EmailNotVerifiedException;
use Grocelivery\IdentityProvider\Http\Controllers\Controller;
use Grocelivery\IdentityProvider\Http\Requests\LoginUser;
use Grocelivery\IdentityProvider\Models\User;
use Grocelivery\IdentityProvider\Services\Auth\OAuthProxy;

/**
 * Class LoginController
 * @package Grocelivery\IdentityProvider\Http\Controllers\Auth
 */
class LoginController extends Controller
{
    /** @var OAuthProxy */
    protected $oAuthProxy;

    /**
     * LoginController constructor.
     * @param JsonResponse $response
     * @param OAuthProxy $oAuthProxy
     */
    public function __construct(JsonResponse $response, OAuthProxy $oAuthProxy)
    {
        parent::__construct($response);
        $this->oAuthProxy = $oAuthProxy;
    }

    /**
     * @param LoginUser $request
     * @return JsonResponse
     * @throws Exception
     */
    public function login(LoginUser $request): JsonResponse
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $response = $this->oAuthProxy->getTokenFromCredentials($email, $password);

        if (!User::findByEmail($email)->hasVerifiedEmail()) {
            throw new EmailNotVerifiedException();
        }

        return $this->response->add('accessToken', $response->get('access_token'));
    }
}
