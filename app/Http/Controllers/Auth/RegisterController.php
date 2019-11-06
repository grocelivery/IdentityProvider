<?php

namespace Grocelivery\IdentityProvider\Http\Controllers\Auth;

use Grocelivery\IdentityProvider\Http\Controllers\Controller;
use Grocelivery\IdentityProvider\Http\Requests\RegisterUser;
use Grocelivery\IdentityProvider\Http\Resources\UserResource;
use Grocelivery\IdentityProvider\Interfaces\Http\Responses\ResponseInterface as Response;
use Grocelivery\IdentityProvider\Services\Auth\RegisterService;

/**
 * Class RegisterController
 * @package Grocelivery\IdentityProvider\Http\Controllers\Auth
 */
class RegisterController extends Controller
{
    /** @var RegisterService */
    protected $registerService;

    /**
     * RegisterController constructor.
     * @param Response $response
     * @param RegisterService $registerService
     */
    public function __construct(Response $response, RegisterService $registerService)
    {
        parent::__construct($response);
        $this->registerService = $registerService;
    }

    /**
     * @param RegisterUser $request
     * @return Response
     */
    public function register(RegisterUser $request): Response
    {
        $email = $request->get('email');
        $password = $request->get('password');

        $user = $this->registerService->registerUser($email, $password);

        return $this->response->withResource('user', new UserResource($user));
    }
}