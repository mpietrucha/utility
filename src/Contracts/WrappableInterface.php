<?php

namespace Mpietrucha\Utility\Contracts;

interface WrappableInterface extends CreatableInterface
{
    /**
     * Wrap the given value in a new instance or return it if already an instance.
     */
    public static function wrap(mixed $value, mixed ...$arguments): object;
}
