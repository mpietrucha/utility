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

    public function cwd(): string
    {
        return $this->adapter()->cwd();
    }

    public function binary(?string $name = null): array
    {
        return $this->adapter()->binary($name);
    }

    public function file(): string
    {
        return $this->adapter()->file();
    }

    public function exists(string $package): bool
    {
        return $this->adapter()->exists($package);
    }

    public function unexists(string $package): bool
    {
        return $this->adapter()->unexists($package);
    }

    public function configure(callable $callback): void
    {
        $this->adapter()->configure($callback);
    }

    public function require(array|string $packages, bool $dev = false, ?OutputInterface $output = null, ?string $binary = null): bool
    {
        return $this->adapter()->require($packages, $dev, $output, $binary);
    }

    public function remove(array|string $packages, bool $dev = false, ?OutputInterface $output = null, ?string $binary = null): bool
    {
        return $this->adapter()->remove($packages, $dev, $output, $binary);
    }
}
