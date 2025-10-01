<?php

namespace Mpietrucha\Utility\Filesystem;

use Illuminate\Support\Arr;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Filesystem\Contracts\SnapshotInterface;
use Mpietrucha\Utility\Filesystem\Snapshot\None;

class Snapshot extends None
{
    /**
     * @var \Mpietrucha\Utility\Collection<int, \Mpietrucha\Utility\Filesystem\Contracts\SnapshotInterface>
     */
    protected static ?Collection $handlers = null;

    public static function use(SnapshotInterface $handler, int $index = 0): void
    {
        static::handlers()->splice($index, 0, Arr::wrap($handler));
    }

    public static function flush(): void
    {
        static::$handlers = null;
    }

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
     * @return array<int, \Mpietrucha\Utility\Filesystem\Contracts\SnapshotInterface>
     */
    protected static function defaults(): array
    {
        return [
            Snapshot\Fd::create(),
            Snapshot\Finder::create(),
        ];
    }
}
