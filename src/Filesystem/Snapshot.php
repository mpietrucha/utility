<?php

namespace Mpietrucha\Utility\Filesystem;

use Illuminate\Support\Arr;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Filesystem\Contracts\SnapshotInterface;
use Mpietrucha\Utility\Filesystem\Snapshot\Fd;
use Mpietrucha\Utility\Filesystem\Snapshot\Finder;
use Mpietrucha\Utility\Filesystem\Snapshot\None;

class Snapshot extends None
{
    /**
     * @var \Mpietrucha\Utility\Collection<int, \Mpietrucha\Utility\Filesystem\Contracts\SnapshotInterface>
     */
    protected static ?Collection $handlers = null;

    /**
     * Register a custom snapshot handler at the specified index.
     */
    public static function use(SnapshotInterface $handler, int $index = 0): void
    {
        static::handlers()->splice($index, 0, Arr::wrap($handler));
    }

    /**
     * Clear all registered snapshot handlers.
     */
    public static function flush(): void
    {
        static::$handlers = null;
    }

    /**
     * Get the snapshot hash for the given input using the first matching handler.
     */
    public function get(string $input, ?string $algorithm = null): ?string
    {
        return static::handlers()->firstMap->get($input, $algorithm);
    }

    /**
     * @return \Mpietrucha\Utility\Collection<int, \Mpietrucha\Utility\Filesystem\Contracts\SnapshotInterface>
     */
    protected static function handlers(): Collection
    {
        return static::$handlers ??= static::defaults() |> Collection::create(...);
    }

    /**
     * @return list<\Mpietrucha\Utility\Filesystem\Contracts\SnapshotInterface>
     */
    protected static function defaults(): array
    {
        return [
            Fd::create(),
            Finder::create(),
        ];
    }
}
