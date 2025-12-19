<?php

namespace Mpietrucha\Utility\Enumerable\Middleware;

class Flip extends None
{
    public function arguments(mixed $value, mixed $key): array
    {
        return [$key, $value];
    }
}
