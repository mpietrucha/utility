<?php

namespace Mpietrucha\Utility\Composer\Contracts;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

interface AutoloadInterface extends InteractsWithAutoloadInterface
{
    public static function load(string $input, ?CursorInterface $cursor = null, ?string $cwd = null): static;

    public static function default(?CursorInterface $cursor = null): AutoloadInterface;

    public static function get(): AutoloadInterface;

    public function composer(): ComposerInterface;

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<array-key, mixed>
     */
    public function cursor(): EnumerableInterface;

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
