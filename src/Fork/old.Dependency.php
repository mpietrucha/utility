<?php

namespace Mpietrucha\Utility\Fork;

use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Filesystem\Path;
use Mpietrucha\Utility\Normalizer;

class Dependency
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

    public static function bootstrap(): void
    {
        static::load(...) |> static::defaults()->each(...);
    }

    public static function load(string $dependency): bool
    {
        if (static::require($dependency)) {
            return true;
        }

        return static::require(...) |> static::variants($dependency)->first(...) |> Normalizer::boolean(...);
    }

    protected static function require(string $dependency): bool
    {
        if (Filesystem::unexists($dependency)) {
            return false;
        }

        Filesystem::requireOnce($dependency);

        return true;
    }

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, string>
     */
    protected static function variants(string $dependency): EnumerableInterface
    {
        return static::variant(...) |> Collection::sequence(3, $dependency)->map(...);
    }

    protected static function variant(string $dependency, int $level): string
    {
        $cwd = Path::directory(Filesystem::cwd() |> Normalizer::string(...), $level);

        return Path::build($dependency, $cwd);
    }
}
