<?php

namespace Mpietrucha\Utility\Forward;

use Mpietrucha\Utility\Forward\Contracts\ContextInterface;
use Mpietrucha\Utility\Forward\Contracts\MethodsInterface;
use Mpietrucha\Utility\Normalizer;

/**
 * @template T of object
 *
 * @extends \Mpietrucha\Utility\Forward\Proxy<T>
 */
class Context extends Proxy implements ContextInterface
{
    /**
     * Create a new boolean context proxy for the given source and expected result.
     */
    public function __construct(protected bool $value, object|string $source, ?MethodsInterface $methods = null)
    {
        parent::__construct($source, $methods);
    }

    /**
     * Forward the method call and return true when its boolean result matches the expected context value.
     */
    public function __call(string $method, array $arguments): bool
    {
        $value = parent::__call($method, $arguments);

        return Normalizer::boolean($value) === $this->value;
    }

    /**
     * Create a context that succeeds when the forwarded method returns true.
     */
    public static function is(object|string $source, ?MethodsInterface $methods = null): static
    {
        return static::create(true, $source, $methods);
    }

    /**
     * Create a context that succeeds when the forwarded method returns false.
     */
    public static function not(object|string $source, ?MethodsInterface $methods = null): static
    {
        return static::create(false, $source, $methods);
    }
}
