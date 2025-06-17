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
     * @param  class-string<T>|T  $instance
     * @return static<T>
     */
    public static function deep(object|string $instance): static
    {
        return static::create($instance);
    }
}
