<?php

namespace Mpietrucha\Utility;

use Laravel\SerializableClosure\SerializableClosure;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

abstract class Instance
{
    /**
     * Determine if the given instance refers to an existing class, interface, or trait.
     *
     * @phpstan-assert-if-true object|class-string $instance
     */
    public static function exists(object|string $instance, bool $autoload = false): bool
    {
        if (Type::object($instance)) {
            return true;
        }

        if (class_exists($instance, $autoload)) {
            return true;
        }

        if (interface_exists($instance, $autoload)) {
            return true;
        }

        return trait_exists($instance, $autoload);
    }

    /**
     * Determine if the given instance does not refer to any known class, interface, or trait.
     */
    final public static function unexists(object|string $instance, bool $autoload = false): bool
    {
        return static::exists($instance, $autoload) |> Normalizer::not(...);
    }

    /**
     * Determine if the instance is or extends the specified class or object.
     */
    public static function is(object|string $instance, object|string $value): bool
    {
        $value = static::namespace($value);

        if (Type::null($value)) {
            return false;
        }

        return is_a($instance, $value, Type::string($instance));
    }

    /**
     * Determine if not the instance is or extends the specified class or object.
     */
    final public static function not(object|string $instance, object|string $value): bool
    {
        return static::is($instance, $value) |> Normalizer::not(...);
    }

    /**
     * Resolve the fully qualified class name of the given instance.
     *
     * @return ($instance is object ? class-string : class-string|null)
     */
    public static function namespace(object|string $instance, bool $autoload = false): ?string
    {
        if (Type::object($instance)) {
            return Type::get($instance);
        }

        return static::exists($instance, $autoload) ? $instance : null;
    }

    /**
     * Resolve the file path of the given instance.
     */
    public static function file(object|string $instance): ?string
    {
        $namespace = static::namespace($instance);

        if (Type::null($namespace)) {
            return null;
        }

        $file = Composer::autoload()->file($namespace);

        if (Type::string($file)) {
            return $file;
        }

        return Reflection::create($namespace)->getFileName() ?: null;
    }

    /**
     * Recursively resolve the most distant parent class of the given instance.
     *
     * @return ($instance is object ? class-string : class-string|null)
     */
    public static function deep(object|string $instance): ?string
    {
        if ($deep = get_parent_class($instance)) {
            return static::deep($deep);
        }

        return static::namespace($instance);
    }

    public static function serialize(object $instance, ?string $secret = null): string
    {
        Type::string($secret) && SerializableClosure::setSecretKey($secret);

        $evaluation = serialize(...) |> Value::for(...);

        return new SerializableClosure(fn () => $instance) |> $evaluation->string(...);
    }

    public static function hash(object $instance, ?string $algorithm = null): string
    {
        return static::serialize($instance) |> Hash::bind($algorithm);
    }

    public static function alias(object|string $class, string $alias, bool $autoload = true): ?string
    {
        $class = static::namespace($class, $autoload) |> Normalizer::string(...);

        if (static::unexists($class)) {
            return null;
        }

        if (@class_alias($class, $alias, false) |> Normalizer::not(...)) {
            return null;
        }

        return static::file($class);
    }

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, class-string>
     */
    public static function parents(object|string $instance): EnumerableInterface
    {
        $parents = @class_parents($instance) |> Collection::create(...);

        return $parents->filter()->values();
    }
}
