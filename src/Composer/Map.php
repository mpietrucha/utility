<?php

namespace Mpietrucha\Utility\Composer;

use Mpietrucha\Utility\Composer\Contracts\MapInterface;
use Mpietrucha\Utility\Composer\Map\Registered;
use Mpietrucha\Utility\Composer\Map\Runtime;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Normalizer;

abstract class Map implements CreatableInterface, MapInterface
{
    use Creatable;

    /**
     * Determine if the namespace does not exist in the map.
     */
    public function unexists(string $namespace): bool
    {
        return $this->exists($namespace) |> Normalizer::not(...);
    }

    /**
     * Get the appropriate map for the given working directory.
     */
    protected static function get(string $cwd): MapInterface
    {
        return match (true) {
            Registered::compatible($cwd) => Registered::load($cwd),
            default => Runtime::load($cwd),
        };
    }
}
