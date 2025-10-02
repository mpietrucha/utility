<?php

namespace Mpietrucha\Utility\Finder\Contracts;

use Countable;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Symfony\Component\Finder\Finder as Adapter;

interface FinderInterface extends Countable, InteractsWithFinderInterface
{
    public static function builder(): BuilderInterface;

    public function adapter(): Adapter;

    public function cache(): CacheInterface;

    public function identifier(): IdentifierInterface;

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Mpietrucha\Utility\Filesystem\Contracts\RecordInterface>
     */
    public function get(): EnumerableInterface;
}
