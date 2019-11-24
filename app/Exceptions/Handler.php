<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Exceptions;

use Exception;
use Grocelivery\Utils\Exceptions\ErrorRenderer;
use Grocelivery\Utils\Interfaces\JsonResponseInterface as JsonResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Container\Container;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

/**
 * Class Handler
 * @package Grocelivery\IdentityProvider\Exceptions
 */
class Handler extends ExceptionHandler
{
    /** @var ErrorRenderer */
    protected $errorRenderer;

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
     * @param ErrorRenderer $errorRenderer
     */
    public function __construct(Container $container, ErrorRenderer $errorRenderer)
    {
        parent::__construct($container);
        $this->errorRenderer = $errorRenderer;
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
     * @return JsonResponse
     */
    public function render($request, Exception $exception): JsonResponse
    {
        $this->errorRenderer->additionallyHandle(
            ModelNotFoundException::class,
            HttpResponse::HTTP_NOT_FOUND,
            'Not found.'
        );

        $this->errorRenderer->additionallyHandle(
            AuthenticationException::class,
            HttpResponse::HTTP_UNAUTHORIZED
        );

        return $this->errorRenderer->render($request, $exception);
    }
}
