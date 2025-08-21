<?php

namespace Mpietrucha\Utility\Fork;

use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Fork\Contracts\TransformerInterface;
use Mpietrucha\Utility\Instance;
use Mpietrucha\Utility\Instance\FQN;
use Mpietrucha\Utility\Type;

abstract class Alias
{
    /**
     * @var \Mpietrucha\Utility\Collection<string, string>|null
     */
    protected static ?Collection $aliases = null;

    public static function transformer(TransformerInterface $transformer): void
    {
        [$class, $alias] = [$transformer->class(), $transformer->namespace()];

        static::class($class, $alias);
    }

    public static function class(string $class, string $alias): void
    {
        [$namespace, $alias] = [static::normalize($class), static::normalize($alias)];

        if (Instance::unexists($class)) {
            return;
        }

        static::namespace($namespace, $alias);
    }

    public static function namespace(string $namespace, string $alias): void
    {
        static::aliases()->put($alias, $namespace);
    }

    public static function get(string $alias): ?string
    {
        $namespace = static::normalize($alias) |> static::aliases()->get(...);

        if (Type::null($namespace)) {
            return null;
        }

        return static::build($namespace, $alias);
    }

    protected static function build(string $namespace, string $alias): ?string
    {
        $class = FQN::join($namespace, FQN::name($alias));

        return Instance::alias($class, $alias);
    }

    protected static function normalize(string $namespace): string
    {
        return FQN::namespace($namespace);
    }

    /**
     * @return \Mpietrucha\Utility\Collection<string, string>
     */
    protected static function aliases(): Collection
    {
        return static::$aliases ??= Collection::create();
    }
}
