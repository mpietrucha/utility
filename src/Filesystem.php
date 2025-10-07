<?php

namespace Mpietrucha\Utility;

use Illuminate\Filesystem\Filesystem as Adapter;
use Mpietrucha\Utility\Enumerable\LazyCollection;
use Mpietrucha\Utility\Filesystem\Concerns\InteractsWithCondition;
use Mpietrucha\Utility\Filesystem\Concerns\InteractsWithExistence;
use Mpietrucha\Utility\Filesystem\Condition;
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
        $bridge = static::adapter() |> static::bridge(...);

        return $bridge->eval($method, $arguments);
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

    public static function temporary(): mixed
    {
        return tmpfile() ?: null;
    }

    /**
     * Create a temporary ephemeral file.
     */
    public static function ephemeral(?string $name = null): string
    {
        return Filesystem\Ephemeral::get($name);
    }

    public static function touch(string $path, ?int $modified = null, ?int $accessed = null): bool
    {
        return touch($path, $modified, $accessed);
    }

    public static function executable(string $path): bool
    {
        return is_executable($path);
    }

    /**
     * Read the file line by line into a lazy collection of strings.
     *
     * @return \Mpietrucha\Utility\Enumerable\LazyCollection<int, string>
     */
    public static function lines(string $file): LazyCollection
    {
        return LazyCollection::create(...) |> static::adapter()->lines($file)->pipe(...);
    }

    public static function hash(string $path, ?string $algorithm = null): ?string
    {
        $algorithm = Hash::algorithm($algorithm);

        return static::adapter()->hash($path, $algorithm) ?: null;
    }

    public static function snapshot(string $path, ?string $algorithm = null): ?string
    {
        return Filesystem\Snapshot::create()->get($path, $algorithm);
    }

    public static function tokenize(string $path): Tokenizer
    {
        return static::get($path) |> Tokenizer::create(...);
    }

    public static function namespace(string $path, bool $canonicalized = false): ?string
    {
        $namespace = Composer::autoload()->namespace($path, $canonicalized);

        if (Type::string($namespace)) {
            return $namespace;
        }

        return static::tokenize($path)->path()->get($canonicalized);
    }

    /**
     * Create a condition handler specific to the filesystem.
     */
    protected static function condition(): Condition\Filesystem
    {
        return Condition\Filesystem::create();
    }
}
