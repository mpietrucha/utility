<?php

namespace Mpietrucha\Utility\Fork;

use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Fork\Contracts\TransformerInterface;
use Mpietrucha\Utility\Instance\Alias as Adapter;
use Mpietrucha\Utility\Instance\FQN;
use Mpietrucha\Utility\Type;

abstract class Alias
{
    protected static ?Collection $aliases = null;

    public static function transformer(TransformerInterface $transformer): void
    {
        [$class, $alias] = [$transformer->class(), $transformer->namespace()];

        static::register($class, $alias);
    }

    public static function register(string $class, string $alias): void
    {
        [$class, $alias] = [static::normalize($class), static::normalize($alias)];

        static::aliases()->put($alias, $class);
    }

    public static function for(string $alias): ?string
    {
        $namespace = static::normalize($alias) |> static::aliases()->get(...);

        if (Type::null($namespace)) {
            return null;
        }

        $class = FQN::join($namespace, FQN::name($alias));

        return Adapter::set($class, $alias);
    }

    protected static function normalize(string $namespace): string
    {
        return FQN::namespace($namespace);
    }

    protected static function aliases(): Collection
    {
        return static::$aliases ??= Collection::create();
    }
}
