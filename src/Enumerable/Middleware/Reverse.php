<?php

namespace Mpietrucha\Utility\Enumerable\Middleware;

use Mpietrucha\Utility\Arr;

class Reverse extends None
{
    public function arguments(array $arguments): array
    {
        return Arr::reverse($arguments);
    }
}
