<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Forward\Context;
use Mpietrucha\Utility\Forward\Contracts\ContextInterface;

abstract class Type
{
    /**
     * Create a new forward context that negates the type check.
     *
     * @return \Mpietrucha\Utility\Forward\Context<static>
     */
    public static function not(): ContextInterface
    {
        return Context::not(static::class, Context::deny('get'));
    }

    /**
     * Get the debug-friendly type name of the given value.
     *
     * @template T
     *
     * @phpstan-param T $value
     *
     * @phpstan-return (T is object ? class-string<T> : string)
     */
    public static function get(mixed $value): string
    {
        return get_debug_type($value);
    }

    /**
     * Determine if the given value is null.
     *
     * @phpstan-assert-if-true null $value
     */
    public static function null(mixed $value): bool
    {
        return is_null($value);
    }

    /**
     * Determine if the given value is a boolean.
     *
     * @phpstan-assert-if-true bool $value
     */
    public static function boolean(mixed $value): bool
    {
        return is_bool($value);
    }

    /**
     * Determine if the given value is an integer.
     *
     * @phpstan-assert-if-true int $value
     */
    public static function integer(mixed $value): bool
    {
        return is_int($value);
    }

    /**
     * Determine if the given value is a float.
     *
     * @phpstan-assert-if-true float $value
     */
    public static function float(mixed $value): bool
    {
        return is_float($value);
    }

    /**
     * Determine if the given value is numeric.
     *
     * @phpstan-assert-if-true int|float $value
     */
    public static function numeric(mixed $value): bool
    {
        return is_numeric($value);
    }

    /**
     * Determine if the given value is a string.
     *
     * @phpstan-assert-if-true string $value
     */
    public static function string(mixed $value): bool
    {
        return is_string($value);
    }

    /**
     * Determine if the given value is an array.
     *
     * @phpstan-assert-if-true array<int|string, mixed> $value
     */
    public static function array(mixed $value): bool
    {
        return is_array($value);
    }

    /**
     * Determine if the given value is a resource.
     *
     * @phpstan-assert-if-true resource $value
     */
    public static function resource(mixed $value): bool
    {
        return is_resource($value);
    }

    /**
     * Determine if the given value is an object.
     *
     * @phpstan-assert-if-true object $value
     */
    public static function object(mixed $value): bool
    {
        return is_object($value);
    }

    /**
     * Determine if the given value is a scalar.
     *
     * @phpstan-assert-if-true scalar $value
     */
    public static function scalar(mixed $value): bool
    {
        return is_scalar($value);
    }

    /**
     * Determine if the given value is callable.
     *
     * @phpstan-assert-if-true callable $value
     */
    public static function callable(mixed $value): bool
    {
        return is_callable($value);
    }

    /**
     * Determine if the given value is countable.
     *
     * @phpstan-assert-if-true array<int|string, mixed>|\Countable $value
     */
    public static function countable(mixed $value): bool
    {
        return is_countable($value);
    }

    /**
     * Determine if the given value is iterable.
     *
     * @phpstan-assert-if-true iterable<int|string, mixed> $value
     */
    public static function iterable(mixed $value): bool
    {
        return is_iterable($value);
    }
}
