<?php

namespace Mpietrucha\Utility\Error;

use Mpietrucha\Utility\Concerns\Arrayable;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Error\Contracts\BuilderInterface;
use Mpietrucha\Utility\Error\Contracts\HandlerInterface;
use Mpietrucha\Utility\Error\Handler\Runtime;

class Builder implements BuilderInterface, CreatableInterface
{
    use Arrayable, Creatable;

    protected bool $supported = false;

    protected mixed $capturable = null;

    /**
     * Create a new error handler builder for the given adapter.
     */
    public function __construct(protected object $adapter)
    {
    }

    /**
     * Create a new builder instance with the given adapter.
     */
    public static function adapter(object $adapter): static
    {
        return static::create($adapter);
    }

    /**
     * Convert the builder configuration to an array.
     */
    final public function toArray(): array
    {
        return [
            $this->adapter,
            $this->supported,
            $this->capturable,
        ];
    }

    /**
     * Set whether the error handler is supported.
     */
    public function supported(bool $supported): static
    {
        $this->supported = $supported;

        return $this;
    }

    /**
     * Set the capturable error types.
     */
    public function capture(mixed $capturable): static
    {
        $this->capturable = $capturable;

        return $this;
    }

    /**
     * Build and return the configured error handler.
     */
    public function build(): HandlerInterface
    {
        return Runtime::create(...) |> $this->toCollection()->pipeSpread(...);
    }
}
