<?php

namespace Mpietrucha\Utility\Enumerable\Middleware;

class Flip extends None
{
    public function key(mixed $key, mixed $value): mixed
    {
        return $value;
    }

    public function value(mixed $value, mixed $key): mixed
    {
        return $key;
    }
}
