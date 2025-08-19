<?php

namespace Mpietrucha\Utility;

use Illuminate\Filesystem\Filesystem as Adapter;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Enumerable\LazyCollection;
use Mpietrucha\Utility\Filesystem\Concerns\InteractsWithCondition;
use Mpietrucha\Utility\Filesystem\Concerns\InteractsWithExistence;
use Mpietrucha\Utility\Filesystem\Condition;
use Mpietrucha\Utility\Finder\Builder;
use Mpietrucha\Utility\Forward\Concerns\Bridgeable;

/**
 * @mixin \Illuminate\Filesystem\Filesystem
 */
abstract class Filesystem
{
    /**
     * @use \Mpietrucha\Utility\Filesystem\Concerns\InteractsWithCondition<\Mpietrucha\Utility\Filesystem\Condition\Filesystem>
     */
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
     * Get the underlying Illuminate filesystem adapter instance.
     */
    public static function adapter(): Adapter
    {
        return static::$adapter ??= new Adapter;
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
    public static function open(string $path, ?string $mode = null): mixed
    {
        $mode ??= 'w+';

        return @fopen($path, $mode) ?: null;
    }

    public static function touch(string $path, ?int $modified = null, ?int $accessed = null): bool
    {
        return touch($path, $modified, $accessed);
    }

    /**
     * Read the file line by line into a lazy collection of stringable objects.
     *
     * @return \Mpietrucha\Utility\Enumerable\LazyCollection<int, \Mpietrucha\Utility\Stringable>
     */
    public static function lines(string $file): LazyCollection
    {
        $lines = LazyCollection::create(...) |> static::adapter()->lines($file)->pipe(...);

        return $lines->of()->stringables();
    }

    public static function hash(string $path, ?string $algorithm = null): string
    {
        $algorithm ??= Hash::default();

        return static::adapter()->hash($path, $algorithm);
    }

    public static function imprint(string $path, ?string $algorithm = null): ?string
    {
        if (static::unexists($path)) {
            return null;
        }

        $timestamp = static::lastModified($path);

        if (static::not()->directory($path)) {
            return static::hash($timestamp, $algorithm);
        }

        $algorithm ??= Hash::default();

        $directories = Finder::uncached(function (Builder $builder) use ($path) {
            $builder->in($path);
        })->directories()->get();

        return $directories->pipeThrough([
            fn (EnumerableInterface $directories) => $directories->map->lastModified(),
            fn (EnumerableInterface $directories) => $directories->merge($timestamp),
            fn (EnumerableInterface $directories) => $directories->hash($algorithm),
        ]);
    }

    /**
     * Create a condition handler specific to the filesystem.
     */
    protected static function condition(): Condition\Filesystem
    {
        return Condition\Filesystem::create();
    }
}
