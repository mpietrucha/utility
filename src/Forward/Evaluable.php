<?php

namespace Mpietrucha\Utility\Forward;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Forward\Contracts\EvaluableInterface;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Type;

class Evaluable implements CreatableInterface, EvaluableInterface
{
    use Creatable;

    /**
     * Create a new evaluable wrapper for the given source class or object.
     *
     * @param  object|class-string  $source
     */
    public function __construct(protected object|string $source)
    {
    }

    /**
     * Dynamically invoke the given method with arguments based on whether the source is instantiated.
     */
    public function __invoke(string $method, array $arguments): mixed
    {
        return match (true) {
            $this->instantiated() => static::call($method, $arguments, $this->source()),
            $this->uninstantiated() => static::bind($method, $arguments, $this->source())
        };
    }

    /**
     * Call an instance method on the given object using bound closure syntax.
     *
     * @param  array<array-key, mixed>  $arguments
     */
    public static function call(string $method, array $arguments, object $source): mixed
    {
        /** @phpstan-ignore-next-line variable.undefined */
        $closure = fn () => $this->$method(...$arguments);

        return $closure->call($source);
    }

    /**
     * Call a static method on the given class using a bound closure.
     *
     * @param  array<array-key, mixed>  $arguments
     * @param  class-string  $source
     */
    public static function bind(string $method, array $arguments, string $source): mixed
    {
        $closure = fn () => static::$method(...$arguments);

        return $closure->bindTo(null, $source)();
    }

    /**
     * Get the original class or object used as the method call source.
     */
    public function source(): object|string
    {
        return $this->source;
    }

    /**
     * Determine whether the source is an object instance.
     */
    public function instantiated(): bool
    {
        return $this->source() |> Type::object(...);
    }

    /**
     * Determine whether the source is a class name rather than an instance.
     */
    public function uninstantiated(): bool
    {
        return $this->instantiated() |> Normalizer::not(...);
    }
}
