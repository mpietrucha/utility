<?php

namespace Mpietrucha\Utility\Finder\Contracts;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Symfony\Component\Finder\Finder as Adapter;

interface LoopInterface
{
    /**
     * Configure the given adapter for looping.
     */
    public static function adapter(Adapter $adapter): Adapter;

    /**
     * Get the files from the adapter.
     *
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Symfony\Component\Finder\SplFileInfo>
     */
    public static function files(?Adapter $adapter = null): EnumerableInterface;

    /**
     * Determine if the input is available for looping.
     */
    public static function available(string $input): bool;

    /**
     * Determine if the loop has finished at the given altitude.
     */
    public static function finished(string $input, ?int $altitude): bool;

    /**
     * Get the next input and altitude for the loop.
     *
     * @return array{0: string, 1: int}
     */
    public static function next(string $input, int $altitude): array;

    /**
     * Convert the files to a response.
     *
     * @param  \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Symfony\Component\Finder\SplFileInfo>  $files
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Mpietrucha\Utility\Filesystem\Contracts\RecordInterface>
     */
    public static function response(EnumerableInterface $files): EnumerableInterface;

    /**
     * Run the loop and return the results.
     *
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Mpietrucha\Utility\Filesystem\Contracts\RecordInterface>
     */
    public static function run(Adapter $adapter, string $input, ?int $altitude): EnumerableInterface;
}
