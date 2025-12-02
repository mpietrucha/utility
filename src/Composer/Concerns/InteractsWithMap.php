<?php

namespace Mpietrucha\Utility\Composer\Concerns;

/**
 * @phpstan-require-implements \Mpietrucha\Utility\Composer\Contracts\MapInterface
 * @phpstan-require-implements \Mpietrucha\Utility\Composer\Contracts\InteractsWithMapInterface
 */
trait InteractsWithMap
{
    /**
     * Determine if a namespace exists in the map.
     */
    public function exists(string $namespace): bool
    {
        return $this->map()->exists($namespace);
    }

    /**
     * Determine if a namespace does not exist in the map.
     */
    public function unexists(string $namespace): bool
    {
        return $this->map()->unexists($namespace);
    }

    /**
     * Get the file path for the given namespace.
     */
    public function file(string $namespace): ?string
    {
        return $this->map()->file($namespace);
    }

    /**
     * Get the namespace for the given file path.
     */
    public function namespace(string $file): ?string
    {
        return $this->map()->namespace($file);
    }
}
