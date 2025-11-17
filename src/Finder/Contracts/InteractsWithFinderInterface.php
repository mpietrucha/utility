<?php

namespace Mpietrucha\Utility\Finder\Contracts;

interface InteractsWithFinderInterface
{
    /**
     * Set the directory to search in.
     */
    public function in(string $input, ?string $directory = null): static;

    /**
     * Climb up the directory tree by the given distance.
     */
    public function climb(int $distance = PHP_INT_MAX): static;
}
