<?php

namespace Mpietrucha\Utility\Composer\Cursor;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

class Memory extends Generator
{
    public function get(string $input): EnumerableInterface
    {
        return parent::get($input)->collect();
    }
}
