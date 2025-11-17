<?php

namespace Mpietrucha\Utility\Fork\Storage;

use Mpietrucha\Utility\Instance\Path;
use Mpietrucha\Utility\Str;

abstract class Transformer
{
    /**
     * Get the transformed content for the given namespace.
     */
    public static function get(string $namespace): string
    {
        return Str::sprintf('namespace %s;', $namespace);
    }

    /**
     * Get the namespace declaration for the given class.
     */
    public static function namespace(string $class): string
    {
        return Path::namespace($class) |> static::get(...);
    }
}
