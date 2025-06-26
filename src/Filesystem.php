<?php

namespace Mpietrucha\Utility;

use Illuminate\Filesystem\Filesystem as Adapter;
use Mpietrucha\Utility\Filesystem\Concerns\InteractsWithCondition;
use Mpietrucha\Utility\Filesystem\Concerns\InteractsWithExistence;
use Mpietrucha\Utility\Filesystem\Condition;
use Mpietrucha\Utility\Forward\Concerns\Bridgeable;
use Mpietrucha\Utility\Illuminate\LazyCollection;
use Mpietrucha\Utility\Illuminate\Stringable;

/**
 * @mixin \Illuminate\Filesystem\Filesystem
 */
abstract class Filesystem
{
    use Bridgeable, InteractsWithCondition, InteractsWithExistence;

    protected static ?Adapter $adapter = null;

    /**
     * Dynamically forward static method calls to the underlying filesystem adapter.
     *
     * @param  array<int|string, mixed>  $arguments
     */
    public static function __callStatic(string $method, array $arguments): mixed
    {
        $adapter = static::adapter();

        return static::bridge($adapter)->eval($method, $arguments);
    }

    /**
     * Get the current working directory or null if unavailable.
     */
    public static function cwd(): ?string
    {
        return getcwd() ?: null;
    }

    /**
     * Open a file with the given mode and return its stream resource or null on failure.
     *
     * @return resource|null
     */
    public static function open(string $path, string $mode): mixed
    {
        return @fopen($path, $mode) ?: null;
    }

    /**
     * Read the file line by line into a lazy collection of stringable objects.
     *
     * @return \Mpietrucha\Utility\Illuminate\LazyCollection<int, \Mpietrucha\Utility\Illuminate\Stringable>
     */
    public static function lines(string $file): LazyCollection
    {
        $lines = static::adapter()->lines($file);

        return LazyCollection::create($lines)->map(Stringable::create(...));
    }

    /**
     * Create a condition handler specific to the filesystem.
     */
    protected static function condition(): Condition\Filesystem
    {
        return Condition\Filesystem::create();
    }

    /**
     * Get the underlying Illuminate filesystem adapter instance.
     */
    protected static function adapter(): Adapter
    {
        return static::$adapter ??= new Adapter;
    }
}
