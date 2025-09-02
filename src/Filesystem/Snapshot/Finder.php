<?php

namespace Mpietrucha\Utility\Filesystem\Snapshot;

use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Filesystem\Record;
use Mpietrucha\Utility\Finder as Adapter;

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

        return $this->directories($input)->pipeThrough([
            fn (EnumerableInterface $directories) => Record::create($input) |> Arr::wrap(...) |> $directories->merge(...),
            fn (EnumerableInterface $directories) => $directories->map->lastModified(),
            fn (EnumerableInterface $directories) => $directories->hash($algorithm),
        ]);
    }

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Mpietrucha\Utility\Filesystem\Contracts\RecordInterface>
     */
    protected function directories(string $input): EnumerableInterface
    {
        return $this->adapter()->in($input)->get();
    }

    protected function adapter(): Adapter
    {
        return Adapter::uncached()->directories();
    }
}
