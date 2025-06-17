<?php

namespace Mpietrucha\Utility\Illuminate;

use Mpietrucha\Utility\Illuminate\Concerns\Enumerable;
use Mpietrucha\Utility\Illuminate\Contracts\EnumerableInterface;

class LazyCollection extends \Illuminate\Support\LazyCollection implements EnumerableInterface
{
    use Enumerable;
}
