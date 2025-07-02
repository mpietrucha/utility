<?php

namespace Mpietrucha\Utility\Finder\Contracts;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

interface CacheInterface
{
    public function identify(): string;

    /**
     * @phpstan-assert-if-true \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Mpietrucha\Utility\Finder\Contracts\FileInterface> $this->get()
     *
     * @phpstan-assert-if-false null $this->get()
     */
    public function exists(): bool;

    /**
     * @phpstan-assert-if-true null $this->get()
     *
     * @phpstan-assert-if-false \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Mpietrucha\Utility\Finder\Contracts\FileInterface> $this->get()
     */
    public function unexists(): bool;

    public function flush(): void;

    public function validate(): void;

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Mpietrucha\Utility\Finder\Contracts\FileInterface>|null
     */
    public function get(): ?EnumerableInterface;

    /**
     * @param  \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Mpietrucha\Utility\Finder\Contracts\FileInterface>  $response
     */
    public function set(EnumerableInterface $response): void;
}
