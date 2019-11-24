<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Http\Controllers;

use Grocelivery\Utils\Interfaces\JsonResponseInterface as JsonResponse;
use Illuminate\Foundation\Application;

/**
 * Class StatusController
 * @package Grocelivery\IdentityProvider\Http\Controllers
 */
class StatusController extends Controller
{
    /** @var Application */
    private $application;

    /**
     * StatusController constructor.
     * @param JsonResponse $response
     * @param Application $application
     */
    public function __construct(JsonResponse $response, Application $application)
    {
        parent::__construct($response);
        $this->application = $application;
    }

    /**
     * @return JsonResponse
     */
    public function getStatus(): JsonResponse
    {
        return $this->response
            ->add('app', config('app.name'))
            ->add('version', config('app.version'))
            ->add('framework', $this->application->version())
            ->add('status', 'healthy');
    }
}
