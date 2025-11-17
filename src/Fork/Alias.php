<?php

namespace Mpietrucha\Utility\Fork;

use Mpietrucha\Utility\Fork\Concerns\InteractsWithAutoload;
use Mpietrucha\Utility\Fork\Contracts\InteractsWithAutoloadInterface;
use Mpietrucha\Utility\Fork\Contracts\OverrideInterface;
use Mpietrucha\Utility\Instance;
use Mpietrucha\Utility\Instance\Path;
use Mpietrucha\Utility\Type;

abstract class Alias implements InteractsWithAutoloadInterface
{
    /**
     * @use \Mpietrucha\Utility\Fork\Concerns\InteractsWithAutoload<string, string>
     */
    use InteractsWithAutoload;

    /**
     * Register a class alias from the transformer configuration.
     */
    public static function override(OverrideInterface $override): void
    {
        [$class, $alias] = [$override->class(), $override->namespace()];

        static::class($class, $alias);
    }

    /**
     * Register a class alias by mapping the original class to its alias.
     */
    public static function class(string $class, string $alias): void
    {
        [$namespace, $alias] = [static::normalize($class), static::normalize($alias)];

        static::namespace($namespace, $alias);
    }

    /**
     * Register a namespace alias in the autoload map.
     */
    public static function namespace(string $namespace, string $alias): void
    {
        static::bootstrap();

        static::autoload()->put($alias, $namespace);
    }

    /**
     * Require and alias a class when the alias is requested.
     */
    protected static function require(string $alias): void
    {
        $namespace = static::normalize($alias) |> static::autoload()->get(...);

        if (Type::null($namespace)) {
            return;
        }

        $name = Path::name($alias);

        Instance::alias(Path::join($namespace, $name), $alias);
    }

    /**
     * Normalize a namespace string to standard format.
     */
    protected static function normalize(string $namespace): string
    {
        return Path::namespace($namespace);
    }
}
