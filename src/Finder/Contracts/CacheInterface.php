<?php

namespace Mpietrucha\Utility\Finder\Contracts;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

interface CacheInterface
{
    public function flush(): void;

    /**
     * @phpstan-assert-if-true \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Mpietrucha\Utility\Filesystem\Contracts\ElementInterface> $this->get()
     *
     * @phpstan-assert-if-false null $this->get()
     */
    public function exists(string $identity): bool;

    /**
     * @phpstan-assert-if-true null $this->get()
     *
     * @phpstan-assert-if-false \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Mpietrucha\Utility\Filesystem\Contracts\ElementInterface> $this->get()
     */
    public function unexists(string $identity): bool;

    public function delete(string $identity): void;

    public function validate(string $identity, string $summit): void;

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Mpietrucha\Utility\Filesystem\Contracts\ElementInterface>|null
     */
    public function get(string $identity): ?EnumerableInterface;

    /**
     * @param  \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Mpietrucha\Utility\Filesystem\Contracts\ElementInterface>  $response
     */
    public function set(string $identity, EnumerableInterface $response): void;
}
