<?php

namespace Mpietrucha\Utility\Composer\Concerns;

use Symfony\Component\Console\Output\OutputInterface;

/**
 * @phpstan-require-implements \Mpietrucha\Utility\Composer\Contracts\AdapterInterface
 * @phpstan-require-implements \Mpietrucha\Utility\Composer\Contracts\InteractsWithAdapterInterface
 */
trait InteractsWithAdapter
{
    use InteractsWithAutoloader;

    /**
     * Get the current working directory.
     */
    public function cwd(): string
    {
        return $this->adapter()->cwd();
    }

    /**
     * Get the Composer binary path.
     */
    public function binary(?string $name = null): array
    {
        return $this->adapter()->binary($name);
    }

    /**
     * Get the composer.json file path.
     */
    public function file(): string
    {
        return $this->adapter()->file();
    }

    /**
     * Determine if a package exists in the dependencies.
     */
    public function exists(string $package): bool
    {
        return $this->adapter()->exists($package);
    }

    /**
     * Determine if a package does not exist in the dependencies.
     */
    public function unexists(string $package): bool
    {
        return $this->adapter()->unexists($package);
    }

    /**
     * Configure the Composer adapter with a callback.
     */
    public function configure(callable $callback): void
    {
        $this->adapter()->configure($callback);
    }

    /**
     * Require one or more packages.
     */
    public function require(array|string $packages, bool $dev = false, ?OutputInterface $output = null, ?string $binary = null): bool
    {
        return $this->adapter()->require($packages, $dev, $output, $binary);
    }

    /**
     * Remove one or more packages.
     */
    public function remove(array|string $packages, bool $dev = false, ?OutputInterface $output = null, ?string $binary = null): bool
    {
        return $this->adapter()->remove($packages, $dev, $output, $binary);
    }
}
