<?php

namespace Mpietrucha\Utility\Throwable\Concerns;

use Mpietrucha\Utility\Instance;
use Mpietrucha\Utility\Throwable\Contracts\ThrowableInterface;
use Mpietrucha\Utility\Type;

trait Throwable
{
    use InteractsWithThrowable;

    public function __construct()
    {
        $this->clean();
    }

    /**
     * Get the underlying throwable instance.
     */
    public function value(): ThrowableInterface
    {
        return $this;
    }

    protected function clean(): void
    {
        $namespace = $this->backtrace()->first()?->namespace();

        if (Type::null($namespace)) {
            return;
        }

        Instance::is($this, $namespace) && $this->align()->clean();
    }
}
