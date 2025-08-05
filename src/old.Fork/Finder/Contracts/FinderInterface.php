<?php

namespace Mpietrucha\Utility\Finder\Contracts;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

interface FinderInterface
{
    public static function builder(): BuilderInterface;

    public function fresh(): FinderInterface;

    public function in(string $input): FinderInterface;

    public function quota(int $limit): FinderInterface;

    public function depth(int $deepness): FinderInterface;

    public function adapter(): AdapterInterface;

    public function cache(): CacheInterface;

    public function identifier(): IdentifierInterface;

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Mpietrucha\Utility\Finder\Contracts\FileInterface>
     */
    public function get(): EnumerableInterface;
}
