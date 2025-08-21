<?php

namespace Mpietrucha\Utility\Finder\Snapshot;

use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Type;

class Timestamp extends None
{
    protected static ?string $file = null;

    /**
     * @var \Mpietrucha\Utility\Collection<string, string>|null
     */
    protected static ?Collection $snapshots = null;

    public static function use(string $file): void
    {
        static::$file = $file;

        static::$snapshots = null;
    }

    public static function update(): void
    {
        [$file, $snapshots] = [static::file(), static::snapshots()->toJson()];

        Filesystem::put($file, $snapshots);
    }

    public function get(string $input): ?string
    {
        return Filesystem::snapshot($input);
    }

    public function expired(string $input): bool
    {
        $snapshot = $this->get($input);

        if (Type::null($snapshot)) {
            return true;
        }

        if (static::snapshots()->get($input) === $snapshot) {
            return false;
        }

        static::update(...) |> static::snapshots()->put($input, $snapshot)->tap(...);

        return true;
    }

    /**
     * @return \Mpietrucha\Utility\Collection<string, string>
     */
    protected static function snapshots(): Collection
    {
        return static::$snapshots ??= static::file() |> Filesystem::json(...) |> Collection::create(...);
    }

    protected static function file(): string
    {
        return static::$file ??= Filesystem\Touch::file('../snapshots.json', __DIR__);
    }
}
