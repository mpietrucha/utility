<?php

namespace Mpietrucha\Utility\Filesystem;

use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Filesystem\Contracts\SnapshotInterface;
use Mpietrucha\Utility\Filesystem\Snapshot\None;

class Snapshot extends None
{
    protected static ?Collection $handlers = null;

    public static function handler(SnapshotInterface $handler, int $index = 0): void
    {
        static::handlers()->splice(index, 0, $handler);
    }

    public function get(string $input, ?string $algorithm = null): ?string
    {
        return static::handlers()->firstMap->get($input, $algorithm);
    }

    protected static function handlers(): Collection
    {
        return static::$handlers ??= static::defaults() |> Collection::create(...);
    }

    protected static function defaults(): array
    {
        return [
            Snapshot\Fd::create(),
            Snapshot\Finder::create(),
        ];
    }
}
