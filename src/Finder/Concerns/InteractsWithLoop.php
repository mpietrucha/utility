<?php

namespace Mpietrucha\Utility\Finder\Concerns;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Enumerable\LazyCollection;
use Mpietrucha\Utility\Filesystem\Path;
use Mpietrucha\Utility\Finder\Result;
use Mpietrucha\Utility\Type;
use Symfony\Component\Finder\Finder as Adapter;

trait InteractsWithLoop
{
    public static function adapter(Adapter $adapter): Adapter
    {
        return clone $adapter;
    }

    public static function files(?Adapter $adapter = null, ?EnumerableInterface $files = null): EnumerableInterface
    {
        return LazyCollection::create($adapter);
    }

    public static function available(?string $input): bool
    {
        return Type::string($input);
    }

    public static function finished(string $input, ?int $altitude): bool
    {
        if ($input === Path::root($input)) {
            return true;
        }

        return Type::null($altitude) || $altitude <= 0;
    }

    public static function next(string $input, int $altitude): array
    {
        return [Path::directory($input), --$altitude];
    }

    public static function response(EnumerableInterface $files): EnumerableInterface
    {
        return Result::create(...) |> $files->map(...);
    }
}
