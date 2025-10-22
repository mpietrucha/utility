<?php

namespace Mpietrucha\Utility\Composer\Concerns;

/**
 * @phpstan-require-implements \Mpietrucha\Utility\Composer\Contracts\LoaderInterface
 * @phpstan-require-implements \Mpietrucha\Utility\Composer\Contracts\InteractsWithLoaderInterface
 */
trait InteractsWithLoader
{
    public function exists(string $namespace): bool
    {
        return $this->loader()->exists($namespace);
    }

    public function unexists(string $namespace): bool
    {
        return $this->loader()->unexists($namespace);
    }

    public function file(string $namespace): ?string
    {
        return $this->loader()->file($namespace);
    }

    public function namespace(stirng $file): ?string
    {
        return $this->loader()->namespace($file);
    }
}
