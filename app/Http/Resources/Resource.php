<?php

declare(strict_types=1);

namespace Grocelivery\IdentityProvider\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class Resource
 * @package Grocelivery\IdentityProvider\Http\Resources
 */
abstract class Resource
{
    /** @var Arrayable */
    protected $resource;

    /**
     * Resource constructor.
     * @param Arrayable $resource
     */
    public function __construct(Arrayable $resource)
    {
        $this->resource = $resource;
    }

    /**
     * @return array
     */
    public function map(): array
    {
        $data = [];

        if ($this->resource instanceof Collection) {
            foreach ($this->resource as $resource) {
                $this->resource = $resource;
                $data[] = $this->toArray();
            }
        } else {
            $data = $this->toArray();
        }

        return $data;
    }

    /**
     * @return array
     */
    abstract public function toArray(): array;
}
