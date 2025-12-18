<?php

namespace Mpietrucha\Utility;

use Closure;
use Laravel\SerializableClosure\Support\ReflectionClosure;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Reflection\Contracts\ReflectionInterface;
use ReflectionClass;
use ReflectionEnum;
use UnitEnum;

/**
 * @template TSource of object
 *
 * @extends \ReflectionClass<TSource>
 */
class Reflection extends ReflectionClass implements CreatableInterface, ReflectionInterface
{
    use Creatable;

    /**
     * Create a reflection of the deepest parent class for the given instance or class.
     *
     * @param  class-string<TSource>|TSource  $instance
     * @return static<TSource>
     */
    public static function deep(object|string $instance): static
    {
        return static::create(Instance::deep($instance) ?? $instance);
    }

    /**
     * Create a reflection of the given callable.
     */
    public static function callable(callable $callable): ReflectionClosure
    {
        return new ReflectionClosure(Closure::fromCallable($callable));
    }

    /**
     * Create a reflection of the given enum.
     *
     * @param  class-string<\UnitEnum>|\UnitEnum  $instance
     * @return \ReflectionEnum<\UnitEnum>
     */
    public static function enum(string|UnitEnum $instance): ReflectionEnum
    {
        return new ReflectionEnum($instance);
    }

    /**
     * Determine whether the reflected class lacks the specified method.
     */
    final public function doesntHaveMethod(string $method): bool
    {
        return $this->hasMethod($method) |> Normalizer::not(...);
    }

    /**
     * Determine whether the reflected class lacks the specified property.
     */
    final public function doesntHaveProperty(string $property): bool
    {
        return $this->hasProperty($property) |> Normalizer::not(...);
    }
}
