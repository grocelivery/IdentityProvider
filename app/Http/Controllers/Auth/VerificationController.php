<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Http\Controllers\Auth;

use Exception;
use Grocelivery\IdentityProvider\Http\Controllers\Controller;
use Grocelivery\IdentityProvider\Interfaces\Http\Responses\ResponseInterface as Response;
use Grocelivery\IdentityProvider\Models\VerificationToken;
use Grocelivery\IdentityProvider\Services\Auth\EmailVerifier;

/**
 * Class VerificationController
 * @package Grocelivery\IdentityProvider\Http\Controllers\Auth
 */
class VerificationController extends Controller
{
    /** @var EmailVerifier */
    private $emailVerifier;

    /**
     * VerificationController constructor.
     * @param Response $response
     * @param EmailVerifier $emailVerifier
     */
    public function __construct(Response $response, EmailVerifier $emailVerifier)
    {
        parent::__construct($response);
        $this->emailVerifier = $emailVerifier;
    }

    /**
     * @param VerificationToken $token
     * @return Response
     * @throws Exception
     */
    public function verify(VerificationToken $token): Response
    {
        $this->emailVerifier->verify($token);

        return $this->response->setMessage('Email address has been verified.');
    }
}
