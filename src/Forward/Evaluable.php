<?php

namespace Mpietrucha\Utility\Forward;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Error;
use Mpietrucha\Utility\Forward\Contracts\EvaluableInterface;
use Mpietrucha\Utility\Instance;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Type;

/**
 * @phpstan-import-type ForwardInput from \Mpietrucha\Utility\Forward\Contracts\EvaluableInterface
 * @phpstan-import-type MixedArray from \Mpietrucha\Utility\Arr
 */
class Evaluable implements CreatableInterface, EvaluableInterface
{
    use Creatable;

    /**
     * Create a new evaluable wrapper for the given source class or object.
     *
     * @param  ForwardInput  $source
     */
    public function __construct(protected object|string $source)
    {
    }

    /**
     * Dynamically invoke the given method with arguments based on whether the source is instantiated.
     *
     * @param  MixedArray  $arguments
     */
    public function __invoke(string $method, array $arguments): mixed
    {
        return match (true) {
            $this->instantiated() => static::dc($method, $arguments, $this->source()),
            $this->uninstantiated() => static::sc($method, $arguments, $this->source())
        };
    }

    /**
     * Determine if the given source is a valid callable class.
     */
    public static function callable(object|string $source): bool
    {
        return Instance::exists($source, Instance::LOAD);
    }

    /**
     * Get the underlying source, which may be an object instance or a class name.
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
    final public function uninstantiated(): bool
    {
        return $this->instantiated() |> Normalizer::not(...);
    }

    /**
     * Call an instance method on the given object using bound closure syntax.
     *
     * @param  MixedArray  $arguments
     */
    protected static function dc(string $method, array $arguments, object $source): mixed
    {
        $response = @(fn () => $this->$method(...$arguments))->call($source);

        if (Error::last()) {
            return $source->$method(...$arguments);
        }

        return $response;
    }

    /**
     * Call a static method on the given class using a bound closure.
     *
     * @param  MixedArray  $arguments
     * @param  class-string  $source
     */
    protected static function sc(string $method, array $arguments, string $source): mixed
    {
        if (static::callable($source) |> Normalizer::not(...)) {
            return $source::$method();
        }

        return (fn () => static::$method(...$arguments))->bindTo(null, $source)();
    }
}
