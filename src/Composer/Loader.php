<?php

namespace Mpietrucha\Utility\Composer;

use Mpietrucha\Utility\Composer\Contracts\LoaderInterface;
use Mpietrucha\Utility\Composer\Loader\Enumerable;
use Mpietrucha\Utility\Composer\Loader\Internal;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Normalizer;

abstract class Loader implements CreatableInterface, LoaderInterface
{
    use Creatable;

    public function unexists(string $namespace): bool
    {
        return $this->exists($namespace) |> Normalizer::not(...);
    }

    protected static function get(string $cwd): LoaderInterface
    {
        return match (true) {
            Internal::compatible($cwd) => Internal::load($cwd),
            default => Enumerable::load($cwd),
        };
    }
}
