<?php

namespace Mpietrucha\Utility\Finder\Contracts;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

interface CacheInterface
{
    /**
     * Flush all cached items.
     */
    public function flush(): void;

    /**
     * Determine if the cached item exists for the given identity.
     *
     * @phpstan-assert-if-true \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Mpietrucha\Utility\Filesystem\Contracts\RecordInterface> $this->get()
     *
     * @phpstan-assert-if-false null $this->get()
     */
    public function exists(string $identity): bool;

    /**
     * Determine if the cached item does not exist for the given identity.
     *
     * @phpstan-assert-if-true null $this->get()
     *
     * @phpstan-assert-if-false \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Mpietrucha\Utility\Filesystem\Contracts\RecordInterface> $this->get()
     */
    public function unexists(string $identity): bool;

    /**
     * Delete the cached item for the given identity.
     */
    public function delete(string $identity): void;

    /**
     * Validate the cached item for the given identity and summit.
     */
    public function validate(string $identity, string $summit): void;

    /**
     * Get the cached item for the given identity.
     *
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Mpietrucha\Utility\Filesystem\Contracts\RecordInterface>|null
     */
    public function get(string $identity): ?EnumerableInterface;

    /**
     * Set the cached item for the given identity.
     *
     * @param  \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Mpietrucha\Utility\Filesystem\Contracts\RecordInterface>  $response
     */
    public function set(string $identity, EnumerableInterface $response): void;
}
