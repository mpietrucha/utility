<?php

namespace Mpietrucha\Utility\Finder\Contracts;

use Mpietrucha\Utility\Contracts\ArrayableInterface;

/**
 * @extends \Mpietrucha\Utility\Contracts\ArrayableInterface<int, mixed>
 */
interface BuilderInterface extends ArrayableInterface
{
    /**
     * @return array{0: string|null, 1: int|null, 2: int|null, 3: \Mpietrucha\Utility\Finder\Contracts\CacheInterface|null, 4: \Mpietrucha\Utility\Finder\Contracts\AdapterInterface|null, 5: \Mpietrucha\Utility\Finder\Contracts\IdentifierInterface|null}
     */
    public function toArray(): array;

    /**
     * Build and return a fully configured Finder instance
     * based on the current builder configuration.
     */
    public function get(): FinderInterface;
}
