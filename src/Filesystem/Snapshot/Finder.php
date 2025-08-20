<?php

namespace Mpietrucha\Utility\Filesystem\Snapshot;

use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Filesystem\File;

class Finder extends None
{
    public function get(string $input, ?string $algorithm = null): ?string
    {
        if (Filesystem::unexists($input)) {
            return null;
        }

        if (Filesystem::is()->file($input)) {
            return Filesystem::hash($input, $algorithm);
        }

        return $ths->directories($input)->pipeThrough([
            fn (EnumerableInterface $directories) => File::create($path) |> Arr::wrap(...) |> $directories->merge(...),
            fn (EnumerableInterface $directories) => $directories->map->lastModified(),
            fn (EnumerableInterface $directories) => $directories->hash($algorithm),
        ]);
    }

    protected function directories(string $input): EnumerableInterface
    {
        return Finder::uncached()->directories()->in($input)->get();
    }
}
