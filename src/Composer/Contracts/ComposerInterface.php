<?php

namespace Mpietrucha\Utility\Composer\Contracts;

use Mpietrucha\Utility\Contracts\WrappableInterface;
use Mpietrucha\Utility\Utilizer\Contracts\UtilizableInterface;
use Symfony\Component\Console\Output\OutputInterface;

interface ComposerInterface extends InteractsWithAutoloadInterface, UtilizableInterface, WrappableInterface
{
    public static function default(): ComposerInterface;

    public static function get(): ComposerInterface;

    public function cwd(): ?string;

    public function autoload(): AutoloadInterface;

    /**
     * @return array<array-key, string>
     */
    public function binary(?string $name = null): array;

    public function file(): string;

    public function exists(string $package): bool;

    public function unexists(string $package): bool;

    public function configure(callable $callback): void;

    /**
     * @param  string|list<string>  $packages
     */
    public function require(array|string $packages, bool $dev = false, ?OutputInterface $output = null, ?string $binary = null): bool;

    /**
     * @param  string|list<string>  $packages
     */
    public function remove(array|string $packages, bool $dev = false, ?OutputInterface $output = null, ?string $binary = null): bool;
}
