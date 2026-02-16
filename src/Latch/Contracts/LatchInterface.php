<?php

namespace Mpietrucha\Utility\Latch\Contracts;

use Mpietrucha\Utility\Contracts\PassableInterface;
use Mpietrucha\Utility\Contracts\TappableInterface;

interface LatchInterface extends PassableInterface, TappableInterface
{
    /**
     * Create a new latch builder for the given indicator.
     */
    public static function builder(string $indicator): BuilderInterface;

    /**
     * Get the latch indicator.
     */
    public function indicator(): string;

    /**
     * Get the latch adapter instance.
     */
    public function adapter(): AdapterInterface;

    /**
     * Flush the latch adapter storage.
     */
    public function flush(): void;

    /**
     * Determine if the latch is currently acquired.
     */
    public function acquired(): bool;

    /**
     * Determine if the latch is currently released.
     */
    public function released(): bool;

    /**
     * Block execution until the latch is released or the timeout is exceeded.
     */
    public function block(int $sleep = 1, int $timeout = PHP_INT_MAX): bool;

    /**
     * Acquire the latch for the current indicator.
     */
    public function acquire(): void;

    /**
     * Release the latch for the current indicator.
     */
    public function release(): void;

    /**
     * Execute the given callback while the latch is acquired.
     */
    public function while(callable $callback): mixed;
}
