<?php

namespace Mpietrucha\Utility\Forward\Contracts;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

interface MethodsInterface
{
    /**
     * Get the collection of explicitly allowed method names.
     *
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, string>
     */
    public function allowed(): EnumerableInterface;

    /**
     * Get the collection of explicitly denied method names.
     *
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, string>
     */
    public function denied(): EnumerableInterface;

    /**
     * Add the given method(s) to the denied list.
     *
     * @param  string|list<string>  $methods
     */
    public function deny(array|string $methods): static;

    /**
     * Add the given method(s) to the allowed list.
     *
     * @param  string|list<string>  $methods
     */
    public function allow(array|string $methods): static;

    /**
     * Ensure that the given method is valid in the context of the provided instance.
     */
    public function validate(string $method, object|string $instance): void;

    /**
     *  Determine whether the given method is permitted based on the current rules.
     */
    public function valid(string $method): bool;

    /**
     * Determine whether the given method is explicitly denied or not allowed.
     */
    public function invalid(string $method): bool;
}
