<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Filesystem\Cwd;
use Mpietrucha\Utility\Filesystem\Path;

/**
 * @internal
 */
abstract class Dependency
{
    /**
     * @var list<string>
     */
    protected static array $defaults = [
        'vendor/illuminate/collections/helpers.php',
        'vendor/laravel/framework/src/Illuminate/Collections/helpers.php',
    ];

    /**
     * Get the default dependency file paths.
     *
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, string>
     */
    public static function defaults(): EnumerableInterface
    {
        return static::$defaults |> Collection::create(...);
    }

    /**
     * Bootstrap the dependency files that exist.
     *
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, string>
     */
    public static function bootstrap(): EnumerableInterface
    {
        return static::load(...) |> static::defaults()->filter(...);
    }

    /**
     * Load the given dependency file.
     */
    public static function load(string $dependency): bool
    {
        $cwd = Cwd::get();

        return Path::build($dependency, $cwd) |> static::require(...);
    }

    /**
     * Require the dependency file if it exists.
     */
    protected static function require(string $dependency): bool
    {
        if (Filesystem::unexists($dependency)) {
            return false;
        }

        Filesystem::requireOnce($dependency);

        return true;
    }
}
