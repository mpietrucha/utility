<?php

namespace Mpietrucha\Utility\Finder\Cache;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Filesystem\Record;
use Mpietrucha\Utility\Filesystem\Stream;
use Mpietrucha\Utility\Filesystem\Temporary;
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

    /**
     * Create a new file-based cache with optional custom directory, lottery, and snapshot.
     */
    public function __construct(
        protected ?string $directory = null,
        protected ?LotteryInterface $lottery = null,
        protected ?SnapshotInterface $snapshot = null,
    ) {
    }

    /**
     * Flush all cached finder results from the cache directory.
     */
    public function flush(): void
    {
        $this->directory() |> Temporary::flush(...);
    }

    /**
     * Determine if a cached file exists for the given identity.
     */
    public function exists(string $identity): bool
    {
        return $this->file($identity) |> Filesystem::is()->file(...);
    }

    /**
     * Delete the cached file for the given identity.
     */
    public function delete(string $identity): void
    {
        $this->file($identity) |> Filesystem::delete(...);
    }

    /**
     * Validate the cache by occasionally flushing and checking snapshot expiration.
     */
    public function validate(string $identity, string $summit): void
    {
        $this->flush(...) |> $this->lottery()->wins(...);

        $this->snapshot()->expired($summit) && $this->delete($identity);
    }

    /**
     * Get the cached finder results for the given identity.
     */
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
            fn (EnumerableInterface $response) => Record::create(...) |> $response->mapSpread(...),
        ]);
    }

    /**
     * Set the cached finder results for the given identity.
     */
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

    /**
     * Get the cache file path for the given identity.
     */
    protected function file(string $identity): string
    {
        return Temporary::get($identity, $this->directory());
    }

    /**
     * Get the cache directory path.
     */
    protected function directory(): string
    {
        return $this->directory ??= static::utilize();
    }

    /**
     * Get the lottery instance for probabilistic cache flushing.
     */
    protected function lottery(): LotteryInterface
    {
        return $this->lottery ??= Lottery::odds(1, 1000);
    }

    /**
     * Get the snapshot instance for tracking filesystem changes.
     */
    protected function snapshot(): SnapshotInterface
    {
        return $this->snapshot ??= Snapshot\Filesystem::create();
    }

    /**
     * Create a temporary directory for finder cache storage.
     */
    protected static function hydrate(): string
    {
        return Temporary::directory('finder');
    }
}
