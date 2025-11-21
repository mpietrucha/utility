<?php

namespace Mpietrucha\Utility\Forward\Contracts;

/**
 * @phpstan-import-type MixedArray from \Mpietrucha\Utility\Arr
 */
interface ProxyInterface
{
    /**
     * Forward the dynamic method call and its arguments to the underlying
     * proxied instance, returning whatever value the target produces.
     *
     * @param  MixedArray  $arguments
     */
    public function __call(string $method, array $arguments): mixed;

    /**
     * Create a method restriction allowing only the specified methods.
     *
     * @param  string|list<string>  $methods
     */
    public static function allow(array|string $methods): MethodsInterface;

    /**
     * Create a method restriction denying the specified methods.
     *
     * @param  string|list<string>  $methods
     */
    public static function deny(array|string $methods): MethodsInterface;
}
