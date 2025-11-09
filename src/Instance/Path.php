<?php

namespace Mpietrucha\Utility\Instance;

use Mpietrucha\Utility\Filesystem\Path as Adapter;
use Mpietrucha\Utility\Str;

abstract class Path
{
    /**
     * Get the namespace delimiter character.
     */
    public static function delimiter(): string
    {
        return Str::backslash();
    }

    /**
     * Join namespace elements together with proper delimiter.
     */
    public static function join(string ...$elements): string
    {
        return Adapter::join(...$elements) |> static::normalize(...);
    }

    /**
     * Canonicalize a namespace by ensuring it starts with the delimiter.
     */
    public static function canonicalize(string $namespace): string
    {
        $delimiter = static::delimiter();

        return static::join($delimiter, $namespace);
    }

    /**
     * Extract the class name from a fully qualified namespace.
     */
    public static function name(string $namespace): string
    {
        return Adapter::normalize($namespace) |> Adapter::name(...);
    }

    /**
     * Extract the namespace portion without the class name.
     */
    public static function namespace(string $namespace, ?int $level = null): string
    {
        return Adapter::directory($namespace, $level) |> static::normalize(...);
    }

    /**
     * Normalize a namespace string by replacing file path delimiters with namespace delimiters.
     */
    protected static function normalize(string $namespace): string
    {
        $delimiter = Adapter::delimiter();

        return Str::replace($delimiter, static::delimiter(), $namespace);
    }
}
