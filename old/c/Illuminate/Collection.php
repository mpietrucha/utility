<?php

namespace Mpietrucha\Utility\Illuminate;

use Mpietrucha\Utility\Illuminate\Concerns\Enumerable;
use Mpietrucha\Utility\Illuminate\Contracts\EnumerableInterface;

class Collection extends \Illuminate\Support\Collection implements EnumerableInterface
{
    use Enumerable;
}
