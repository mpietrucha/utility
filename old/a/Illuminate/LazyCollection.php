<?php

namespace Mpietrucha\Utility\Illuminate;

use Mpietrucha\Utility\Contracts\ArrayableInterface;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Illuminate\Concerns\Enumerable;

class LazyCollection extends \Illuminate\Support\LazyCollection implements ArrayableInterface, CreatableInterface
{
    use Enumerable;
}
