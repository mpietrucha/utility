<?php

namespace Mpietrucha\Utility\Utilizer\Concerns;

/**
 * @phpstan-require-implements \Mpietrucha\Utility\Utilizer\Contracts\UtilizableInterface
 */
trait Utilizable
{
    protected static mixed $utilizable = null;

    /**
     * Set the utilizable value to be used.
     */
    public static function use(): void
    {
        func_get_arg(0) |> static::utilizable(...);
    }

    /**
     * Get the utilizable value, initializing if needed.
     */
    public static function utilize(): mixed
    {
        return static::$utilizable ??= static::hydrate();
    }

    /**
     * Store the given utilizable value.
     */
    protected static function utilizable(mixed $utilizable): void
    {
        static::$utilizable = $utilizable;
    }

    /**
     * Hydrate and return the initial utilizable value.
     */
    protected static function hydrate(): mixed
    {
        return null;
    }
}
