<?php

namespace Mpietrucha\Utility\Finder\Contracts;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

interface FinderInterface
{
    public function fresh(): FinderInterface;

    public function attempts(int $depth): FinderInterface;

    public function until(int $target): FinderInterface;

    public function in(string $directory): FinderInterface;

    public function adapter(): AdapterInterface;

    public function cache(): CacheInterface;

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Mpietrucha\Utility\Finder\Contracts\FileInterface>
     */
    public function get(): EnumerableInterface;
}
