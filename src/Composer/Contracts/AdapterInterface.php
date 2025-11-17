<?php

namespace Mpietrucha\Utility\Composer\Contracts;

use Mpietrucha\Utility\Contracts\WrappableInterface;
use Symfony\Component\Console\Output\OutputInterface;

interface AdapterInterface extends InteractsWithAutoloaderInterface, WrappableInterface
{
    /**
     * Get the current working directory.
     */
    public function cwd(): string;

    /**
     * Get the composer binary path.
     *
     * @return array<array-key, string>
     */
    public function binary(?string $name = null): array;

    /**
     * Get the composer.json file path.
     */
    public function file(): string;

    /**
     * Determine if the given package exists.
     */
    public function exists(string $package): bool;

    /**
     * Determine if the given package does not exist.
     */
    public function unexists(string $package): bool;

    /**
     * Configure the composer adapter.
     */
    public function configure(callable $callback): void;

    /**
     * Require the given packages.
     *
     * @param  string|list<string>  $packages
     */
    public function require(array|string $packages, bool $dev = false, ?OutputInterface $output = null, ?string $binary = null): bool;

    /**
     * Remove the given packages.
     *
     * @param  string|list<string>  $packages
     */
    public function remove(array|string $packages, bool $dev = false, ?OutputInterface $output = null, ?string $binary = null): bool;
}
