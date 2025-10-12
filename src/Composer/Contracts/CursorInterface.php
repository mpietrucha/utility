<?php

namespace Mpietrucha\Utility\Composer\Contracts;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

interface CursorInterface
{
    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<array-key, mixed>
     */
    public function get(string $input): EnumerableInterface;
}
