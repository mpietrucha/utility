<?php

namespace Mpietrucha\Utility\Contracts;

interface CreatableInterface
{
    /**
     * Create a new instance of the class with the given arguments.
     */
    public static function create(mixed ...$arguments): static;
}
