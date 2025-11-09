<?php

namespace Mpietrucha\Utility\Finder\Concerns;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Enumerable\LazyCollection;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Filesystem\Path;
use Mpietrucha\Utility\Filesystem\Record;
use Mpietrucha\Utility\Type;
use Symfony\Component\Finder\Finder as Adapter;

/**
 * @phpstan-require-implements \Mpietrucha\Utility\Finder\Contracts\LoopInterface
 */
trait InteractsWithLoop
{
    /**
     * Clone the adapter to avoid state pollution between loop iterations.
     */
    public static function adapter(Adapter $adapter): Adapter
    {
        return clone $adapter;
    }

    /**
     * Create a lazy collection of files from the adapter results.
     */
    public static function files(?Adapter $adapter = null): EnumerableInterface
    {
        return LazyCollection::create($adapter);
    }

    /**
     * Determine if the input path exists and is available for searching.
     */
    public static function available(string $input): bool
    {
        return Filesystem::exists($input);
    }

    /**
     * Determine if the loop has finished based on reaching the root or altitude limit.
     */
    public static function finished(string $input, ?int $altitude): bool
    {
        if ($input === Path::root($input)) {
            return true;
        }

        return Type::null($altitude) || $altitude <= 0;
    }

    /**
     * Get the next input path and decremented altitude for the loop iteration.
     */
    public static function next(string $input, int $altitude): array
    {
        return [Path::directory($input), --$altitude];
    }

    /**
     * Transform the files collection into filesystem records.
     */
    public static function response(EnumerableInterface $files): EnumerableInterface
    {
        return Record::build(...) |> $files->map(...);
    }
}
