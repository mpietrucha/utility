<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Instance\Contracts\InteractsWithInstanceInterface;
use Mpietrucha\Utility\Instance\Serializer;

abstract class Instance implements InteractsWithInstanceInterface
{
    /**
     * Determine if the given instance refers to an existing class, interface, or trait.
     *
     * @phpstan-assert-if-true object|class-string $instance
     */
    public static function exists(object|string $instance, bool $autoload = InteractsWithInstanceInterface::LOAD): bool
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
    final public static function unexists(object|string $instance, bool $autoload = InteractsWithInstanceInterface::LOAD): bool
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
    public static function namespace(object|string $instance, bool $autoload = InteractsWithInstanceInterface::LOAD): ?string
    {
        if (Type::object($instance)) {
            return Type::get($instance);
        }

        return static::exists($instance, $autoload) ? $instance : null;
    }

    /**
     * Resolve the file path of the given instance.
     */
    public static function file(object|string $instance, bool $autoload = InteractsWithInstanceInterface::LAZY): ?string
    {
        $namespace = Type::string($instance) ? $instance : static::namespace($instance);

        $file = Composer::get()->autoload()->file($namespace);

        if (Type::string($file)) {
            return $file;
        }

        if (static::unexists($namespace, $autoload)) {
            return null;
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

    /**
     * Serialize the given object instance to a string.
     */
    public static function serialize(object $instance): string
    {
        return Serializer::serialize($instance);
    }

    /**
     * Unserialize the given string back to an object instance.
     */
    public static function unserialize(string $instance): object
    {
        return Serializer::unserialize($instance);
    }

    /**
     * Generate a hash of the serialized object instance.
     */
    public static function hash(object $instance, ?string $algorithm = null): string
    {
        return static::serialize($instance) |> Hash::bind($algorithm);
    }

    /**
     * Create an alias for the given class.
     */
    public static function alias(object|string $class, string $alias, bool $autoload = InteractsWithInstanceInterface::LOAD): ?string
    {
        $class = static::namespace($class, $autoload) |> Normalizer::string(...);

        if (static::unexists($class)) {
            return null;
        }

        if (@class_alias($class, $alias) |> Normalizer::not(...)) {
            return null;
        }

        return static::file($class);
    }

    /**
     * Get all parent classes of the given class or object.
     *
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, class-string>
     */
    public static function parents(object|string $instance): EnumerableInterface
    {
        $parents = @class_parents($instance) |> Collection::create(...);

        return $parents->filter()->values();
    }

    /**
     * Get all traits used by the given class or object.
     *
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, class-string>
     */
    public static function traits(object|string $instance): EnumerableInterface
    {
        $traits = @class_uses_recursive($instance) |> Collection::create(...);

        return $traits->filter()->values();
    }
}
