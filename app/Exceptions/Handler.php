<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Exceptions;

use Exception;
use Grocelivery\IdentityProvider\Http\Responses\Response;
use Grocelivery\IdentityProvider\Interfaces\Http\Responses\ResponseInterface;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Container\Container;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class Handler
 * @package Grocelivery\IdentityProvider\Exceptions
 */
class Handler extends ExceptionHandler
{
    /** @var Response */
    protected $response;
    /** @var array */
    protected $dontReport = [];

    /** @var array */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Handler constructor.
     * @param Container $container
     * @param Response $response
     */
    public function __construct(Container $container, Response $response)
    {
        parent::__construct($container);
        $this->response = $response;
    }

    /**
     * @param Exception $exception
     * @throws Exception
     */
    public function report(Exception $exception): void
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Exception $exception
     * @return ResponseInterface
     */
    public function render($request, Exception $exception)
    {
        $status = HttpResponse::HTTP_INTERNAL_SERVER_ERROR;
        $errors = [];

        if ($exception instanceof NotFoundHttpException) {
            $status = HttpResponse::HTTP_NOT_FOUND;
            $errors[] = 'Route not found.';
        }

        if ($exception instanceof  ModelNotFoundException) {
            $status = HttpResponse::HTTP_NOT_FOUND;
            $errors[] = 'Not found.';
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            $status = HttpResponse::HTTP_METHOD_NOT_ALLOWED;
            $errors[] = 'Method not allowed.';
        }

        if ($exception instanceof AuthenticationException) {
            $status = HttpResponse::HTTP_UNAUTHORIZED;
            $errors[] = 'Unauthenticated.';
        }

        if ($exception instanceof InternalServerException) {
            $status = $exception->getCode();
            $errors = $exception->getErrors();
        }

        if (empty($errors)) {
            $errors[] = !empty($exception->getMessage()) ? $exception->getMessage() : 'Internal server error.';
        }

        return $this->response
            ->setStatusCode($status)
            ->setErrors($errors);
    }
}
