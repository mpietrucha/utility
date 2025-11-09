<?php

namespace Mpietrucha\Utility\Composer\Concerns;

/**
 * @phpstan-require-implements \Mpietrucha\Utility\Composer\Contracts\LoaderInterface
 * @phpstan-require-implements \Mpietrucha\Utility\Composer\Contracts\InteractsWithLoaderInterface
 */
trait InteractsWithLoader
{
    /**
     * Determine if a namespace exists in the loader.
     */
    public function exists(string $namespace): bool
    {
        return $this->loader()->exists($namespace);
    }

    /**
     * Determine if a namespace does not exist in the loader.
     */
    public function unexists(string $namespace): bool
    {
        return $this->loader()->unexists($namespace);
    }

    /**
     * Get the file path for the given namespace.
     */
    public function file(string $namespace): ?string
    {
        return $this->loader()->file($namespace);
    }

    /**
     * Get the namespace for the given file path.
     */
    public function namespace(stirng $file): ?string
    {
        return $this->loader()->namespace($file);
    }
}
