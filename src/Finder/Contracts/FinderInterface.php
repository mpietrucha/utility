<?php

namespace Mpietrucha\Utility\Finder\Contracts;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Symfony\Component\Finder\Finder as Adapter;

interface FinderInterface
{
    public static function builder(): BuilderInterface;

    public function in(string $input, ?string $base = null): FinderInterface;

    public function climb(int $distance = PHP_INT_MAX): FinderInterface;

    public function adapter(): Adapter;

    public function cache(): CacheInterface;

    public function identifier(): IdentifierInterface;

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Mpietrucha\Utility\Finder\Contracts\ResultInterface>
     */
    public function get(): EnumerableInterface;
}
