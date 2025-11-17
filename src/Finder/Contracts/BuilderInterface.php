<?php

namespace Mpietrucha\Utility\Finder\Contracts;

use Mpietrucha\Utility\Contracts\ArrayableInterface;
use Mpietrucha\Utility\Contracts\TappableInterface;
use Symfony\Component\Finder\Finder as Adapter;

/**
 * @extends \Mpietrucha\Utility\Contracts\ArrayableInterface<int, mixed>
 */
interface BuilderInterface extends ArrayableInterface, InteractsWithFinderInterface, TappableInterface
{
    /**
     * Get the builder configuration as an array.
     *
     * @return array{0: string|null, 1: int|null, 2: \Symfony\Component\Finder\Finder|null, 3: \Mpietrucha\Utility\Finder\Contracts\CacheInterface|null, 4: \Mpietrucha\Utility\Finder\Contracts\IdentifierInterface|null}
     */
    public function toArray(): array;

    /**
     * Set the cache instance.
     */
    public function cache(CacheInterface $cache): static;

    /**
     * Set the Symfony Finder adapter.
     */
    public function adapter(Adapter $adapter): static;

    /**
     * Set the identifier instance.
     */
    public function identifier(IdentifierInterface $identifier): static;

    /**
     * Build and return a fully configured Finder instance
     * based on the current builder configuration.
     */
    public function build(): FinderInterface;
}
