<?php

namespace Mpietrucha\Utility;

use Illuminate\Support\Sleep;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Concerns\Passable;
use Mpietrucha\Utility\Concerns\Tappable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Latch\Adapter\File;
use Mpietrucha\Utility\Latch\Builder;
use Mpietrucha\Utility\Latch\Contracts\AdapterInterface;
use Mpietrucha\Utility\Latch\Contracts\BuilderInterface;
use Mpietrucha\Utility\Latch\Contracts\LatchInterface;
use Mpietrucha\Utility\Latch\Exception\LatchAcquiredException;
use Mpietrucha\Utility\Latch\Exception\LatchReleasedException;
use Mpietrucha\Utility\Latch\Exception\LatchTimeoutException;

class Latch implements CreatableInterface, LatchInterface
{
    use Creatable, Passable, Tappable;

    /**
     * Create a new latch instance for the given indicator.
     */
    public function __construct(protected string $indicator, protected ?AdapterInterface $adapter = null)
    {
    }

    /**
     * Create a new latch builder for the given indicator.
     */
    public static function builder(string $indicator): BuilderInterface
    {
        return Builder::create($indicator);
    }

    /**
     * Get the latch indicator.
     */
    public function indicator(): string
    {
        return $this->indicator;
    }

    /**
     * Get the latch adapter instance.
     */
    public function adapter(): AdapterInterface
    {
        return $this->adapter ??= File::create();
    }

    /**
     * Determine if the latch is currently acquired.
     */
    public function acquired(): bool
    {
        return $this->indicator() |> $this->adapter()->acquired(...);
    }

    /**
     * Determine if the latch is currently released.
     */
    final public function released(): bool
    {
        return $this->acquired() |> Normalizer::not(...);
    }

    /**
     * Block execution until the latch is released or the timeout is exceeded.
     */
    public function block(int $sleep = 1, int $timeout = PHP_INT_MAX): bool
    {
        if ($this->released()) {
            return false;
        }

        $duration = $timeout = Number::abs($timeout);

        while ($this->acquired()) {
            Sleep::for($sleep)->seconds();

            $timeout -= Number::abs($sleep);

            if ($timeout > 0) {
                continue;
            }

            $indicator = $this->indicator();

            LatchTimeoutException::for($indicator, Number::max($sleep, $duration))->throw();
        }

        return true;
    }

    /**
     * Acquire the latch for the current indicator.
     */
    public function acquire(): void
    {
        $indicator = $this->indicator();

        $this->acquired() && LatchAcquiredException::for($indicator)->throw();

        $this->adapter()->acquire($indicator);
    }

    /**
     * Release the latch for the current indicator.
     */
    public function release(): void
    {
        $indicator = $this->indicator();

        $this->released() && LatchReleasedException::for($indicator)->throw();

        $this->adapter()->release($indicator);
    }

    /**
     * Execute the given callback while the latch is acquired.
     */
    public function while(callable $callback): mixed
    {
        $this->acquire();

        $latch = Value::for($callback)->get() |> $this->pass(...);

        return $latch->release();
    }
}
