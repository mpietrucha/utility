<?php

namespace Mpietrucha\Utility;

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
        return static::create(Instance::deep($instance) ?? $instance);
    }

    /**
     * Determine whether the reflected class lacks the specified method.
     */
    final public function doesntHaveMethod(string $method): bool
    {
        return Normalizer::not($this->hasMethod($method));
    }

    /**
     * Determine whether the reflected class lacks the specified property.
     */
    final public function doesntHaveProperty(string $property): bool
    {
        return Normalizer::not($this->hasProperty($property));
    }
}
