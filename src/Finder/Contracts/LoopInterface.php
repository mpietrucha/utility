<?php

namespace Mpietrucha\Utility\Finder\Contracts;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Symfony\Component\Finder\Finder as Adapter;

interface LoopInterface
{
    public static function adapter(Adapter $adapter): Adapter;

    /**
     * @param  \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Symfony\Component\Finder\SplFileInfo>|null  $files
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Symfony\Component\Finder\SplFileInfo>
     */
    public static function files(?Adapter $adapter = null, ?EnumerableInterface $files = null): EnumerableInterface;

    public static function available(?string $input): bool;

    public static function finished(string $input, ?int $altitude): bool;

    /**
     * @return array{0: string, 1: int}
     */
    public static function next(string $input, int $altitude): array;

    /**
     * @param  \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Symfony\Component\Finder\SplFileInfo>  $files
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Mpietrucha\Utility\Filesystem\Contracts\FileInterface>
     */
    public static function response(EnumerableInterface $files): EnumerableInterface;

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Mpietrucha\Utility\Filesystem\Contracts\FileInterface>
     */
    public static function run(Adapter $adapter, ?string $input, ?int $altitude): EnumerableInterface;
}
