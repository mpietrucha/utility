<?php

namespace Mpietrucha\Utility\Filesystem;

use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Filesystem\Concerns\InteractsWithCondition;
use Mpietrucha\Utility\Str;
use Mpietrucha\Utility\Type;
use Symfony\Component\Filesystem\Path as Adapter;

abstract class Path
{
    /**
     * @use \Mpietrucha\Utility\Filesystem\Concerns\InteractsWithCondition<\Mpietrucha\Utility\Filesystem\Condition\Path>
     */
    use InteractsWithCondition;

    /**
     * Get the path delimiter character.
     */
    public static function delimiter(): string
    {
        return Str::slash();
    }

    /**
     * Join multiple path segments into a single path.
     */
    public static function join(string ...$paths): string
    {
        return Adapter::join(...$paths);
    }

    /**
     * Get the name portion of the given path.
     */
    public static function name(string $path): string
    {
        return Filesystem::basename($path);
    }

    /**
     * Ensure the path ends with the given name segment.
     */
    public static function finish(string $path, string $name): string
    {
        if (static::name($path) === $name) {
            return $path;
        }

        return static::join($path, $name);
    }

    /**
     * Canonicalize the given path, resolving symbolic links and relative segments.
     */
    public static function canonicalize(string $path): string
    {
        return Adapter::canonicalize($path);
    }

    /**
     * Normalize the given path by removing redundant directory separators and up-level references.
     */
    public static function normalize(string $path): string
    {
        return Adapter::normalize($path);
    }

    /**
     * Get the directory portion of the given path.
     */
    public static function directory(string $path, ?int $level = null): string
    {
        if ($level === 0) {
            return $path;
        }

        $directory = Adapter::getDirectory($path);

        if (Type::null($level)) {
            return $directory;
        }

        if ($level <= 1) {
            return $directory;
        }

        return static::directory($directory, --$level);
    }

    /**
     * Get the current user’s home directory path.
     */
    public static function home(): string
    {
        return Adapter::getHomeDirectory();
    }

    /**
     * Get the root directory portion of the given path.
     */
    public static function root(string $path): string
    {
        return Adapter::getRoot($path);
    }

    /**
     * Get the filename without its extension from the given path.
     */
    public static function nameWithoutExtension(string $path, ?string $extension = null): string
    {
        return Adapter::getFilenameWithoutExtension($path, $extension);
    }

    /**
     * Create an absolute path by combining the given relative path with a base path.
     */
    public static function absolute(string $path, string $directory): string
    {
        return Adapter::makeAbsolute($path, $directory);
    }

    /**
     * Create a relative path from one path to another base path.
     */
    public static function relative(string $path, string $directory): string
    {
        return Adapter::makeRelative($path, $directory);
    }

    /**
     * Returns canonicalized absolute pathname
     */
    public static function get(string $path): string
    {
        $canonicalized = static::canonicalize($path);

        return realpath($canonicalized) ?: $canonicalized;
    }

    /**
     * Build an absolute path from the given path and optional directory.
     */
    public static function build(string $path, ?string $directory = null): string
    {
        if (Type::null($directory)) {
            return static::get($path);
        }

        return static::absolute($path, $directory);
    }

    /**
     * Get a new Path condition instance for advanced conditional checks.
     */
    protected static function condition(): Condition\Path
    {
        return Condition\Path::create();
    }
}
