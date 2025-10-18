<?php

namespace Mpietrucha\Utility\Composer\Contracts;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Utilizer\Contracts\UtilizableInterface;

interface AutoloadInterface extends InteractsWithAutoloadInterface, UtilizableInterface
{
    public static function load(string $input, null|ComposerInterface|string $composer = null): static;

    public static function default(null|ComposerInterface|string $composer = null): static;

    public function composer(): ComposerInterface;

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, string>
     */
    public function map(): EnumerableInterface;

    /**
     * @phpstan-assert-if-true string $this->file()
     *
     * @phpstan-assert-if-false null $this->file()
     *
     * @phpstan-assert-if-true string $this->namespace()
     *
     * @phpstan-assert-if-false null $this->namespace()
     */
    public function exists(string $namespace): bool;

    /**
     * phpstan-assert-if-true null $this->file()
     *
     * @phpstan-assert-if-false string $this->file()
     *
     * phpstan-assert-if-true null $this->namespace()
     * @phpstan-assert-if-false string $this->namespace()
     */
    public function unexists(string $namespace): bool;

    public function file(string $namespace): ?string;

    public function namespace(string $file, bool $canonicalized = false): ?string;
}
