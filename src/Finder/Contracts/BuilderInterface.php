<?php

namespace Mpietrucha\Utility\Finder\Contracts;

use Mpietrucha\Utility\Contracts\ArrayableInterface;

/**
 * @extends \Mpietrucha\Utility\Contracts\ArrayableInterface<int, mixed>
 */
interface BuilderInterface extends ArrayableInterface
{
    /**
     * @return array{0: int|null, 1: int|null, 2: \Mpietrucha\Utility\Finder\Contracts\CacheInterface|null, 3: \Mpietrucha\Utility\Finder\Contracts\AdapterInterface|null}
     */
    public function toArray(): array;

    /**
     * Build and return a fully configured Finder instance
     * based on the current builder configuration.
     */
    public function get(): FinderInterface;
}
