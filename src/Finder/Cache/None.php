<?php

namespace Mpietrucha\Utility\Finder\Cache;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Finder\Contracts\CacheInterface;
use Mpietrucha\Utility\Normalizer;

class None implements CacheInterface, CreatableInterface
{
    use Creatable;

    public function flush(): void
    {
    }

    public function exists(string $identity): bool
    {
        return false;
    }

    final public function unexists(string $identity): bool
    {
        return $this->exists($identity) |> Normalizer::not(...);
    }

    public function delete(string $identity): void
    {
    }

    public function validate(string $identity, string $summit): void
    {
    }

    public function get(string $identity): ?EnumerableInterface
    {
        return null;
    }

    public function set(string $identity, EnumerableInterface $response): void
    {
    }
}
