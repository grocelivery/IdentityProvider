<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Http\Controllers;

use Grocelivery\IdentityProvider\Interfaces\Http\Responses\ResponseInterface as Response;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class Controller
 * @package Grocelivery\IdentityProvider\Http\Controllers
 */
class Controller extends BaseController
{
    /** @var Response */
    protected $response;

    /**
     * Controller constructor.
     * @param Response $response
     */
    public function __construct(Response $response)
    {
        $this->response = $response;
    }
}
