<?php

namespace Mpietrucha\Utility\Contracts;

interface RouteableInterface extends CreatableInterface
{
    /**
     * Return the given value if it is an instance of the called class,
     * otherwise create and return a new instance with the provided arguments.
     */
    public static function route(mixed $value, mixed ...$arguments): object;
}
