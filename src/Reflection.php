<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Reflection\Concerns\InteractsWithReflection;
use Mpietrucha\Utility\Reflection\Contracts\ReflectionEnumInterface;
use Mpietrucha\Utility\Reflection\Contracts\ReflectionInterface;
use Mpietrucha\Utility\Reflection\Contracts\ReflectionLambdaInterface;
use Mpietrucha\Utility\Reflection\Enum;
use Mpietrucha\Utility\Reflection\Lambda;
use ReflectionClass;

/**
 * @template TSource of object
 *
 * @extends \ReflectionClass<TSource>
 */
class Reflection extends ReflectionClass implements ReflectionInterface
{
    use InteractsWithReflection;

    /**
     * Create a reflection of the deepest parent class for the given instance or class.
     *
     * @param  class-string<TSource>|TSource  $instance
     * @return static<TSource>
     */
    public static function deep(object|string $instance): static
    {
        $deep = Instance::deep($instance);

        return static::create($deep ?? $instance);
    }

    /**
     * Create a reflection of the given enum.
     */
    public static function enum(object|string $enum): ReflectionEnumInterface
    {
        return Enum::create($enum);
    }

    /**
     * Create a reflection of the given lambda.
     */
    public static function lambda(callable $lambda, ?string $code = null): ReflectionLambdaInterface
    {
        return Lambda::create($lambda, $code);
    }
}
