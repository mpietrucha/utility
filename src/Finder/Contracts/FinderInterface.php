<?php

namespace Mpietrucha\Utility\Finder\Contracts;

use Mpietrucha\Utility\Illuminate\Contracts\EnumerableInterface;

interface FinderInterface
{
    /**
     * @return \Mpietrucha\Utility\Illuminate\Contracts\EnumerableInterface<int, \Mpietrucha\Utility\Finder\Contracts\FinderInterface>
     */
    public function get(): EnumerableInterface;
}
