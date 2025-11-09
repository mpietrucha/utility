<?php

namespace Mpietrucha\Utility\Fork\Transformer;

use Mpietrucha\Utility\Instance\Path;
use Mpietrucha\Utility\Str;

class Normalizer
{
    /**
     * Normalize a class name into a class declaration string.
     */
    public static function name(string $class): string
    {
        return Path::name($class) |> Str::of('class %s')->sprintf(...);
    }

    /**
     * Normalize a namespace into a namespace declaration string.
     */
    public static function namespace(string $namespace): string
    {
        return Path::namespace($namespace) |> Str::of('namespace %s;')->sprintf(...);
    }
}
