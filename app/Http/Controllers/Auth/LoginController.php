<?php


namespace Grocelivery\IdentityProvider\Http\Controllers\Auth;


use Grocelivery\IdentityProvider\Http\Controllers\Controller;
use Grocelivery\IdentityProvider\Http\Requests\LoginUser;
use Grocelivery\IdentityProvider\Interfaces\Http\Responses\ResponseInterface as Response;
use Grocelivery\IdentityProvider\Services\Auth\LoginService;

/**
 * Class LoginController
 * @package Grocelivery\IdentityProvider\Http\Controllers\Auth
 */
class LoginController extends Controller
{
    /** @var LoginService */
    protected $loginService;

    public function __construct(Response $response, LoginService $loginService)
    {
        parent::__construct($response);
        $this->loginService = $loginService;
    }

    /**
     * @param LoginUser $request
     * @return Response
     */
    public function login(LoginUser $request): Response
    {
        $email = $request->get('email');
        $password = $request->get('password');

        $accessToken = $this->loginService->loginUser($email, $password);

        return $this->response->add('accessToken', $accessToken);
    }
}