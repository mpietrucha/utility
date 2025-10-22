<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
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
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, string>
     */
    public static function defaults(): EnumerableInterface
    {
        return static::$defaults |> Collection::create(...);
    }

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, string>
     */
    public static function bootstrap(): EnumerableInterface
    {
        return static::load(...) |> static::defaults()->filter(...);
    }

    public static function load(string $dependency): bool
    {
        $cwd = Filesystem::cwd();

        if (Path::build($dependency, $cwd) |> static::require(...)) {
            return true;
        }

        return Path::build($dependency, Path::directory($cwd)) |> static::require(...);
    }

    protected static function require(string $dependency): bool
    {
        if (Filesystem::unexists($dependency)) {
            return false;
        }

        Filesystem::requireOnce($dependency);

        return true;
    }
}
