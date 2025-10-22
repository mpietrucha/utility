<?php

namespace Mpietrucha\Utility\Composer;

use Mpietrucha\Utility\Composer\Contracts\LoaderInterface;
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
            Loader\Composer::compatible($cwd) => Loader\Composer::load($cwd),
            default => Loader\Enumerable::load($cwd),
        };
    }
}
