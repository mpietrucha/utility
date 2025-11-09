<?php

namespace Mpietrucha\Utility\Error\Handler;

use Mpietrucha\Utility\Error\Builder;
use Mpietrucha\Utility\Error\Contracts\BuilderInterface;
use Mpietrucha\Utility\Value;

class Runtime extends None
{
    /**
     * Create a new runtime error handler with the given adapter and configuration.
     */
    public function __construct(protected object $adapter, protected bool $supported = false, protected mixed $capturable = null)
    {
    }

    /**
     * Create a new builder instance for the given adapter.
     */
    public static function builder(object $adapter): BuilderInterface
    {
        return Builder::create($adapter);
    }

    /**
     * Get the underlying error handler adapter.
     */
    public function adapter(): object
    {
        return $this->adapter;
    }

    /**
     * Determine if this handler is supported.
     */
    public function supported(): bool
    {
        return $this->supported;
    }

    /**
     * Capture errors by executing the capturable callback.
     */
    public function capture(): void
    {
        $evaluation = $this->capturable() |> Value::for(...);

        [$this->adapter(), $this->supported(), $this] |> $evaluation->eval(...);
    }

    /**
     * Get the capturable callback.
     */
    protected function capturable(): mixed
    {
        return $this->capturable;
    }
}
