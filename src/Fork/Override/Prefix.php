<?php

namespace Mpietrucha\Utility\Fork\Override;

use Mpietrucha\Utility\Instance\Path;
use Mpietrucha\Utility\Str;
use Mpietrucha\Utility\Utilizer\Concerns\Utilizable;
use Mpietrucha\Utility\Utilizer\Contracts\UtilizableInterface;

abstract class Prefix implements UtilizableInterface
{
    use Utilizable;

    /**
     * Get the override prefix.
     */
    public static function get(): string
    {
        return static::utilize();
    }

    /**
     * Build a namespaced path with the given prefix.
     */
    public static function build(string $namespace, ?string $prefix = null): string
    {
        return Path::join($prefix ?? static::get(), $namespace);
    }

    /**
     * Remove the prefix from the given namespace.
     */
    public static function skip(string $namespace, ?string $prefix = null): ?string
    {
        if (Str::doesntStartWith($namespace, $prefix ??= static::get())) {
            return null;
        }

        return Str::replaceFirst($prefix . Path::delimiter(), Str::none(), $namespace);
    }

    /**
     * Initialize and generate the override prefix.
     */
    protected static function hydrate(): string
    {
        return 'Fork';
    }
}
