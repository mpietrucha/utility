<?php

namespace Mpietrucha\Utility\Finder\Contracts;

use Mpietrucha\Utility\Contracts\ArrayableInterface;
use Mpietrucha\Utility\Contracts\TappableInterface;
use Symfony\Component\Finder\Finder as Adapter;

/**
 * @extends \Mpietrucha\Utility\Contracts\ArrayableInterface<int, mixed>
 */
interface BuilderInterface extends ArrayableInterface, TappableInterface
{
    /**
     * @return array{0: string|null, 1: int|null, 2: \Symfony\Component\Finder\Finder|null, 3: \Mpietrucha\Utility\Finder\Contracts\CacheInterface|null, 4: \Mpietrucha\Utility\Finder\Contracts\IdentifierInterface|null}
     */
    public function toArray(): array;

    public function cache(CacheInterface $cache): BuilderInterface;

    public function adapter(Adapter $adapter): BuilderInterface;

    public function identifier(IdentifierInterface $identifier): BuilderInterface;

    /**
     * Build and return a fully configured Finder instance
     * based on the current builder configuration.
     */
    public function build(): FinderInterface;
}
