<?php

namespace Mpietrucha\Utility\Composer\Contracts;

interface InteractsWithMapInterface
{
    /**
     * Get the map instance.
     */
    public function map(): MapInterface;
}
