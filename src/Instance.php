<?php

namespace Mpietrucha\Utility;

abstract class Instance
{
    /**
     * Determine if the given instance refers to an existing class, interface, or trait.
     *
     * @phpstan-assert-if-true object|class-string $instance
     */
    public static function exists(object|string $instance): bool
    {
        if (Type::object($instance)) {
            return true;
        }

        return class_exists($instance) || trait_exists($instance) || interface_exists($instance);
    }

    /**
     * Determine if the given instance does not refer to any known class, interface, or trait.
     */
    final public static function unexists(object|string $instance): bool
    {
        return static::exists($instance) |> Normalizer::not(...);
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
     * Resolve the fully qualified class name of the given instance.
     *
     * @return class-string|null
     */
    public static function namespace(object|string $instance): ?string
    {
        if (Type::object($instance)) {
            return Type::get($instance);
        }

        return static::exists($instance) ? $instance : null;
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

        return Reflection::create($namespace)->getFileName();
    }

    /**
     * Recursively resolve the most distant parent class of the given instance.
     *
     * @return class-string|null
     */
    public static function deep(object|string $instance): ?string
    {
        if ($deep = get_parent_class($instance)) {
            return static::deep($deep);
        }

        return static::namespace($instance);
    }

    /**
     * @param  null|callable(): string  $serialize
     */
    public static function serialize(object $instance, ?callable $serialize = null): string
    {
        $serialize ??= serialize(...);

        return Value::attempt($serialize)->string($instance);
    }

    /**
     * @param  null|callable(): string  $hash
     * @param  null|callable(): string  $serialize
     */
    public static function hash(object $instance, ?callable $hash = null, ?callable $serialize = null): string
    {
        $hash ??= Hash::md5(...);

        return static::serialize($instance, $serialize) |> $hash(...) |> Normalizer::string(...);
    }
}
