<?php

namespace Mpietrucha\Utility;

use Closure;
use Laravel\SerializableClosure\Support\ReflectionClosure;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Reflection\Contracts\ReflectionInterface;
use ReflectionClass;

/**
 * @template T of object
 *
 * @extends \ReflectionClass<T>
 */
class Reflection extends ReflectionClass implements CreatableInterface, ReflectionInterface
{
    use Creatable;

    /**
     * Create a reflection of the deepest parent class for the given instance or class.
     *
     * @param  class-string<T>|T  $instance
     * @return static<T>
     */
    public static function deep(object|string $instance): static
    {
        $deep = Instance::deep($instance);

        return static::create($deep ?? $instance);
    }

    public static function callable(callable $callable, ?string $code = null): ReflectionClosure
    {
        return new ReflectionClosure(Closure::fromCallable($callable), $code);
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
