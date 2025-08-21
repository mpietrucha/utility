<?php

namespace Mpietrucha\Utility\Finder\Contracts;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Symfony\Component\Finder\Finder as Adapter;

interface FinderInterface
{
    public static function builder(): BuilderInterface;

    public function in(string $input, ?string $base = null): static;

    public function climb(int $distance = PHP_INT_MAX): static;

    public function adapter(): Adapter;

    public function cache(): CacheInterface;

    public function identifier(): IdentifierInterface;

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Mpietrucha\Utility\Filesystem\Contracts\ElementInterface>
     */
    public function get(): EnumerableInterface;
}
