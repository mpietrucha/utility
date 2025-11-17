<?php

namespace Mpietrucha\Utility\Finder\Contracts;

use Symfony\Component\Finder\Finder as Adapter;

interface ReflectionInterface extends \Mpietrucha\Utility\Reflection\Contracts\ReflectionInterface
{
    /**
     * Refresh the reflection state for the given adapter.
     */
    public static function refresh(?Adapter $adapter): void;

    /**
     * Reset the given property on the reflected object.
     */
    public function reset(string $property): void;
}
