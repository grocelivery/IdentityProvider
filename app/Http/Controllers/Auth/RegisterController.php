<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Http\Controllers\Auth;

use Grocelivery\IdentityProvider\Http\Controllers\Controller;
use Grocelivery\IdentityProvider\Http\Requests\RegisterUser;
use Grocelivery\IdentityProvider\Http\Resources\UserResource;
use Grocelivery\IdentityProvider\Interfaces\Http\Responses\ResponseInterface as Response;
use Grocelivery\IdentityProvider\Services\Auth\UserRegistrar;

/**
 * Class RegisterController
 * @package Grocelivery\IdentityProvider\Http\Controllers\Auth
 */
class RegisterController extends Controller
{
    /** @var UserRegistrar */
    protected $userRegistrar;

    /**
     * RegisterController constructor.
     * @param Response $response
     * @param UserRegistrar $userRegistrar
     */
    public function __construct(Response $response, UserRegistrar $userRegistrar)
    {
        parent::__construct($response);
        $this->userRegistrar = $userRegistrar;
    }

    /**
     * @param RegisterUser $request
     * @return Response
     */
    public function register(RegisterUser $request): Response
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = $this->userRegistrar->register($email, $password);

        return $this->response
            ->setMessage('Successfully registered. Email verification link was sent to provided email address.')
            ->withResource('user', new UserResource($user));
    }
}
