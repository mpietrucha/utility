<?php

namespace Mpietrucha\Utility\Finder\Contracts;

use Symfony\Component\Finder\Finder as Adapter;

interface ReflectionInterface extends \Mpietrucha\Utility\Reflection\Contracts\ReflectionInterface
{
    public static function refresh(?Adapter $adapter): void;

    public function reset(string $property): void;
}
