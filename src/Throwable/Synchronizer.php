<?php

namespace Mpietrucha\Utility\Throwable;

use Mpietrucha\Utility\Backtrace\Contracts\FrameInterface;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Throwable\Enums\Property;
use Mpietrucha\Utility\Throwable\Synchronizer\File;
use Mpietrucha\Utility\Throwable\Synchronizer\Line;
use Mpietrucha\Utility\Throwable\Synchronizer\None;

abstract class Synchronizer extends None
{
    /**
     * @var \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, \Mpietrucha\Utility\Throwable\Contracts\SynchronizerInterface>|null
     */
    protected static ?EnumerableInterface $properties = null;

    /**
     * Get property-value groups from synchronizers that match the given frame.
     *
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, array{0: \Mpietrucha\Utility\Throwable\Enums\Property, 1: mixed}>
     */
    public static function groups(FrameInterface $frame): EnumerableInterface
    {
        return static::for($frame)->map->build($frame);
    }

    /**
     * Extract property values from synchronizers that match the given frame.
     *
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
     * Filter synchronizers to only those that exist for the given frame.
     *
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, \Mpietrucha\Utility\Throwable\Contracts\SynchronizerInterface>
     */
    public static function for(FrameInterface $frame): EnumerableInterface
    {
        return static::properties()->filter->exists($frame);
    }

    /**
     * Get the collection of registered synchronizer properties.
     *
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, \Mpietrucha\Utility\Throwable\Contracts\SynchronizerInterface>
     */
    public static function properties(): EnumerableInterface
    {
        return static::$properties ??= static::defaults() |> Collection::create(...);
    }

    /**
     * Get the default synchronizer instances.
     *
     * @return list<\Mpietrucha\Utility\Throwable\Contracts\SynchronizerInterface>
     */
    final protected static function defaults(): array
    {
        return [
            Line::create(),
            File::create(),
        ];
    }
}
