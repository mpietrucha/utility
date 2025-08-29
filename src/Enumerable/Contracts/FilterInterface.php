<?php

namespace Mpietrucha\Utility\Enumerable\Contracts;

interface FilterInterface
{
    public function __invoke(mixed $value): bool;
}
