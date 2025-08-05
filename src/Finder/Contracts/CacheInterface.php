<?php

namespace Mpietrucha\Utility\Finder\Contracts;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

interface CacheInterface
{
    /**
     * @phpstan-assert-if-true \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Mpietrucha\Utility\Finder\Contracts\ResultInterface> $this->get()
     *
     * @phpstan-assert-if-false null $this->get()
     */
    public function exists(string $identity): bool;

    /**
     * @phpstan-assert-if-true null $this->get()
     *
     * @phpstan-assert-if-false \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Mpietrucha\Utility\Finder\Contracts\ResultInterface> $this->get()
     */
    public function unexists(string $identity): bool;

    public function validate(string $identity): void;

    public function delete(string $identity): void;

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Mpietrucha\Utility\Finder\Contracts\ResultInterface>|null
     */
    public function get(string $identity): ?EnumerableInterface;

    /**
     * @param  \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Mpietrucha\Utility\Finder\Contracts\ResultInterface>  $response
     */
    public function set(string $identity, EnumerableInterface $response): void;
}
