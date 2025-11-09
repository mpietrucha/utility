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

    /**
     * Flush all cached finder results.
     */
    public function flush(): void
    {
    }

    /**
     * Determine if a cached result exists for the given identity.
     */
    public function exists(string $identity): bool
    {
        return false;
    }

    /**
     * Determine if a cached result does not exist for the given identity.
     */
    final public function unexists(string $identity): bool
    {
        return $this->exists($identity) |> Normalizer::not(...);
    }

    /**
     * Delete the cached result for the given identity.
     */
    public function delete(string $identity): void
    {
    }

    /**
     * Validate the cached result for the given identity against the summit hash.
     */
    public function validate(string $identity, string $summit): void
    {
    }

    /**
     * Get the cached result for the given identity.
     */
    public function get(string $identity): ?EnumerableInterface
    {
        return null;
    }

    /**
     * Set the cached result for the given identity.
     */
    public function set(string $identity, EnumerableInterface $response): void
    {
    }
}
