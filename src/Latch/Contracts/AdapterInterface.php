<?php

namespace Mpietrucha\Utility\Latch\Contracts;

interface AdapterInterface
{
    /**
     * Flush all latch files from the storage directory.
     */
    public function flush(): void;

    /**
     * Determine if the given indicator is currently acquired.
     */
    public function acquired(string $indicator): bool;

    /**
     * Acquire the latch for the given indicator.
     */
    public function acquire(string $indicator): void;

    /**
     * Release the latch for the given indicator.
     */
    public function release(string $indicator): void;
}
