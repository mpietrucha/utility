<?php

namespace Mpietrucha\Utility\Concerns;

use Mpietrucha\Utility\Instance\Property;
use Mpietrucha\Utility\Normalizer;

/**
 * @phpstan-require-implements \Mpietrucha\Utility\Contracts\RouteableInterface
 */
trait Routeable
{
    use Creatable;

    /**
     * Return the given value if it is an instance of the called class,
     * otherwise create and return a new instance with the provided arguments.
     */
    public static function route(mixed $value, mixed ...$arguments): static
    {
        $instance = static::class;

        $instance = match (true) {
            Property::exists($instance, 'routeable') => static::$routeable,
            default => $instance
        } |> Normalizer::string(...);

        if ($value instanceof $instance) {
            return $value;
        }

        return static::create(...$arguments);
    }
}
