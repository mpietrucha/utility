<?php

namespace Mpietrucha\Utility;

abstract class Phar
{
    public static function inside(): bool
    {
        return static::cwd() |> Type::string(...);
    }

    final public static function outside(): bool
    {
        return static::inside() |> Normalizer::not(...);
    }

    public static function cwd(): ?string
    {
        return static::running(true);
    }

    public static function location(): ?string
    {
        return static::running(false);
    }

    protected static function running(bool $location): ?string
    {
        return \Phar::running($location) |> Str::nullWhenEmpty(...);
    }
}
