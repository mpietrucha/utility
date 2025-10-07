<?php

namespace Mpietrucha\Utility\Finder\Contracts;

interface InteractsWithFinderInterface
{
    public function in(string $input, ?string $directory = null): static;

    public function climb(int $distance = PHP_INT_MAX): static;
}
