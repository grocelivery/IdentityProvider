<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Http\Controllers\Auth;

use Grocelivery\IdentityProvider\Http\Controllers\Controller;
use Grocelivery\Utils\Interfaces\JsonResponseInterface as JsonResponse;

/**
 * Class KeyController
 * @package Grocelivery\IdentityProvider\Http\Controllers\Auth
 */
class KeyController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function getPublicKey(): JsonResponse
    {
        $key = file_get_contents(base_path() . '/storage/oauth-public.key');
        return $this->response->add('key', $key);
    }
}
