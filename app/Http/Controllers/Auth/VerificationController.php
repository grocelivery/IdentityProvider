<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Http\Controllers\Auth;

use Exception;
use Grocelivery\HttpUtils\Interfaces\JsonResponseInterface as JsonResponse;
use Grocelivery\IdentityProvider\Http\Controllers\Controller;
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
     * @param JsonResponse $response
     * @param EmailVerifier $emailVerifier
     */
    public function __construct(JsonResponse $response, EmailVerifier $emailVerifier)
    {
        parent::__construct($response);
        $this->emailVerifier = $emailVerifier;
    }

    /**
     * @param VerificationToken $token
     * @return JsonResponse
     * @throws Exception
     */
    public function verify(VerificationToken $token): JsonResponse
    {
        $this->emailVerifier->verify($token);

        return $this->response->setMessage('Email address has been verified.');
    }
}
