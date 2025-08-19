<?php

namespace Mpietrucha\Utility\Finder\Contracts;

use Mpietrucha\Utility\Contracts\ArrayableInterface;
use Mpietrucha\Utility\Contracts\TappableInterface;

/**
 * @extends \Mpietrucha\Utility\Contracts\ArrayableInterface<int, mixed>
 */
interface BuilderInterface extends ArrayableInterface, TappableInterface
{
    /**
     * @return array{1: string|null, 2: int|null, 3: \Symfony\Component\Finder\Finder|null, 4: \Mpietrucha\Utility\Finder\Contracts\CacheInterface|null, 5: \Mpietrucha\Utility\Finder\Contracts\IdentifierInterface|null}
     */
    public function toArray(): array;

    /**
     * Build and return a fully configured Finder instance
     * based on the current builder configuration.
     */
    public function build(): FinderInterface;
}
