<?php

namespace Mpietrucha\Utility\Instance;

use Mpietrucha\Utility\Filesystem\Path;
use Mpietrucha\Utility\Str;

abstract class FQN
{
    public static function join(string ...$elements): string
    {
        return Path::join(...$elements) |> static::normalize(...);
    }

    public static function canonicalize(string $namespace): string
    {
        return static::join(static::delimiter(), $namespace);
    }

    public static function name(string $namespace): string
    {
        return Path::normalize($namespace) |> Path::name(...);
    }

    public static function namespace(string $namespace, ?int $level = null): string
    {
        return Path::directory($namespace, $level) |> static::normalize(...);
    }

    protected static function normalize(string $namespace): string
    {
        return Str::replace(Str::slash(), static::delimiter(), $namespace);
    }

    protected static function delimiter(): string
    {
        return Str::backslash();
    }
}
