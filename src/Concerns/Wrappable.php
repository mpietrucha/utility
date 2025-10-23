<?php

namespace Mpietrucha\Utility\Concerns;

use Mpietrucha\Utility\Instance\Property;
use Mpietrucha\Utility\Normalizer;

/**
 * @phpstan-require-implements \Mpietrucha\Utility\Contracts\WrappableInterface
 */
trait Wrappable
{
    use Creatable;

    /**
     * Wrap the given value in a new instance of the called class,
     * or return the value if it is already an instance.
     */
    public static function wrap(mixed $value, mixed ...$arguments): object
    {
        $instance = static::class;

        $instance = match (true) {
            Property::exists($instance, 'wrappable') => static::$wrappable,
            default => $instance
        } |> Normalizer::string(...);

        if ($value instanceof $instance) {
            return $value;
        }

        return static::create($value, ...$arguments);
    }
}
