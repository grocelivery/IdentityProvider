<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Http\Controllers;

use Grocelivery\IdentityProvider\Interfaces\Http\Responses\ResponseInterface as Response;
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
     * @param Response $response
     * @param Application $application
     */
    public function __construct(Response $response, Application $application)
    {
        parent::__construct($response);
        $this->application = $application;
    }

    /**
     * @return Response
     */
    public function getStatus(): Response
    {
        return $this->response
            ->add('app', config('app.name'))
            ->add('version', config('app.version'))
            ->add('framework', $this->application->version())
            ->add('status', 'healthy');
    }
}
