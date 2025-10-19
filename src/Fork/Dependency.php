<?php

namespace Mpietrucha\Utility\Fork;

use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Filesystem;

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

    public static function load(string $dependency): void
    {
        Filesystem::exists($dependency) && Filesystem::requireOnce($dependency);
    }
}
