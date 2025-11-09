<?php

namespace Mpietrucha\Utility\Throwable\Concerns;

use Mpietrucha\Utility\Instance;
use Mpietrucha\Utility\Instance\Method;
use Mpietrucha\Utility\Throwable\Contracts\ThrowableInterface;
use Mpietrucha\Utility\Throwable\Purifier;

/**
 * @phpstan-require-implements \Mpietrucha\Utility\Throwable\Contracts\ThrowableInterface
 */
trait Throwable
{
    use InteractsWithConfigurator, InteractsWithThrowable;

    /**
     * Create a new throwable instance and purify its backtrace.
     */
    public function __construct()
    {
        $this->purify();

        Method::exists($this, 'initialize') && $this->initialize();
    }

    /**
     * Get the underlying throwable instance.
     */
    public function value(): ThrowableInterface
    {
        return $this;
    }

    /**
     * Purify the backtrace by removing internal throwable frames.
     */
    protected function purify(): void
    {
        $this->backtrace() |> Purifier::index(...) |> $this->align(...);
    }
}
