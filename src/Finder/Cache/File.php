<?php

namespace Mpietrucha\Utility\Finder\Cache;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Filesystem\Stream;
use Mpietrucha\Utility\Finder\Contracts\SnapshotInterface;
use Mpietrucha\Utility\Finder\Snapshot;
use Mpietrucha\Utility\Lottery;
use Mpietrucha\Utility\Lottery\Contracts\LotteryInterface;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Str;
use Mpietrucha\Utility\Utilizer\Concerns\Utilizable;
use Mpietrucha\Utility\Utilizer\Contracts\UtilizableInterface;

class File extends None implements UtilizableInterface
{
    use Utilizable\Strings;

    public function __construct(
        protected ?string $directory = null,
        protected ?LotteryInterface $lottery = null,
        protected ?SnapshotInterface $snapshot = null,
    ) {
    }

    public function flush(): void
    {
        $this->directory() |> Filesystem\Temporary::flush(...);
    }

    public function exists(string $identity): bool
    {
        return $this->file($identity) |> Filesystem::is()->file(...);
    }

    public function delete(string $identity): void
    {
        $this->file($identity) |> Filesystem::delete(...);
    }

    public function validate(string $identity, string $summit): void
    {
        $this->flush(...) |> $this->lottery()->wins(...);

        $this->snapshot()->expired($summit) && $this->delete($identity);
    }

    public function get(string $identity): ?EnumerableInterface
    {
        if ($this->unexists($identity)) {
            return null;
        }

        $response = $this->file($identity) |> Filesystem::lines(...);

        return $response->pipeThrough([
            fn (EnumerableInterface $response) => $response->mapToStringables(),
            fn (EnumerableInterface $response) => Str::tab() |> $response->map->explode(...),
            fn (EnumerableInterface $response) => Normalizer::string(0) |> $response->keyBy(...),
            fn (EnumerableInterface $response) => Filesystem\Record::create(...) |> $response->mapSpread(...),
        ]);
    }

    public function set(string $identity, EnumerableInterface $response): void
    {
        if ($response->isEmpty()) {
            return;
        }

        $file = $this->file($identity) |> Stream::open(...);

        $response->pipeThrough([
            fn (EnumerableInterface $response) => $response->mapToCollections(),
            fn (EnumerableInterface $response) => Str::tab() |> $response->map->join(...),
            fn (EnumerableInterface $response) => Str::eol(...) |> $response->map(...),
            fn (EnumerableInterface $response) => Str::trim(...) |> $response->replaceFirst(...),
            fn (EnumerableInterface $response) => $file->write(...) |> $response->each(...),
        ]);
    }

    protected function file(string $identity): string
    {
        return Filesystem\Path::join($this->directory(), $identity);
    }

    protected function directory(): string
    {
        return $this->directory ??= static::utilize();
    }

    protected function lottery(): LotteryInterface
    {
        return $this->lottery ??= Lottery::odds(1, 1000);
    }

    protected function snapshot(): SnapshotInterface
    {
        return $this->snapshot ??= Snapshot\Filesystem::create();
    }

    protected static function hydrate(): string
    {
        return Filesystem\Temporary::directory('finder');
    }
}
