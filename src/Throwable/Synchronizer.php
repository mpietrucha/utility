<?php

namespace Mpietrucha\Utility\Throwable;

use Mpietrucha\Utility\Backtrace\Contracts\FrameInterface;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Throwable\Synchronizer\None;

abstract class Synchronizer extends None
{
    /**
     * @var \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, \Mpietrucha\Utility\Throwable\Contracts\SynchronizerInterface>|null
     */
    protected static ?EnumerableInterface $properties = null;

    public static function each(FrameInterface $frame, callable $callback): void
    {
        static::groups($frame)->eachSpread($callback);
    }

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, array{0: \Mpietrucha\Utility\Throwable\Property, 1: mixed}>
     */
    public static function groups(FrameInterface $frame): EnumerableInterface
    {
        return static::for($frame)->map->build($frame);
    }

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, mixed>
     */
    public static function values(FrameInterface $frame): EnumerableInterface
    {
        return static::for($frame)->pipeThrough([
            fn (EnumerableInterface $properties) => $properties->keyBy->property(),
            fn (EnumerableInterface $properties) => $properties->map->value($frame),
        ]);
    }

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, \Mpietrucha\Utility\Throwable\Contracts\SynchronizerInterface>
     */
    public static function for(FrameInterface $frame): EnumerableInterface
    {
        return static::properties()->filter->exists($frame);
    }

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, \Mpietrucha\Utility\Throwable\Contracts\SynchronizerInterface>
     */
    public static function properties(): EnumerableInterface
    {
        return static::$properties ??= static::defaults() |> Collection::create(...);
    }

    /**
     * @return array<int, \Mpietrucha\Utility\Throwable\Contracts\SynchronizerInterface>
     */
    final protected static function defaults(): array
    {
        return [
            Synchronizer\Line::create(),
            Synchronizer\File::create(),
        ];
    }
}
