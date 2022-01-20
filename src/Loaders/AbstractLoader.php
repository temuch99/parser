<?php

namespace App\Loaders;

abstract class AbstractLoader
{
    /**
     * @var string
     */
    protected $address;

    /**
     * @param string $address
     */
    public function __construct(string $address)
    {
        $this->address = $address;
    }

    /**
     * resource typehint not exists
     *
     * @return resource
     */
    abstract public function load();
}
