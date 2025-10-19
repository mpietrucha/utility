<?php

namespace Mpietrucha\Utility\Throwable\Concerns;

use Mpietrucha\Utility\Instance;
use Mpietrucha\Utility\Throwable\Contracts\ThrowableInterface;
use Mpietrucha\Utility\Throwable\Purifier;

/**
 * @phpstan-require-implements \Mpietrucha\Utility\Throwable\Contracts\ThrowableInterface
 */
trait Throwable
{
    use InteractsWithConfigurator, InteractsWithThrowable;

    public function __construct()
    {
        $this->purify();
    }

    /**
     * Get the underlying throwable instance.
     */
    public function value(): ThrowableInterface
    {
        return $this;
    }

    protected function purify(): void
    {
        $this->backtrace() |> Purifier::index(...) |> $this->align(...);
    }
}
