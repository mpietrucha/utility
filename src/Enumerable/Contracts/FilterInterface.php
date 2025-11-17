<?php

namespace Mpietrucha\Utility\Enumerable\Contracts;

interface FilterInterface
{
    /**
     * Determine if the given value should be filtered.
     */
    public function __invoke(mixed $value): bool;
}
