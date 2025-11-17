<?php

namespace Mpietrucha\Utility\Fork\Override;

use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Instance;
use Mpietrucha\Utility\Normalizer as Adapter;

abstract class Normalizer
{
    /**
     * Get the namespace from the given file.
     */
    public static function namespace(string $file): string
    {
        return Filesystem::namespace($file) |> Adapter::string(...);
    }

    /**
     * Get the normalized file path for the given namespace.
     */
    public static function file(string $namespace): string
    {
        return Instance::file($namespace) |> Adapter::string(...);
    }
}
