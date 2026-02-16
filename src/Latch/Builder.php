<?php

namespace Mpietrucha\Utility\Latch;

use Mpietrucha\Utility\Concerns\Arrayable;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Latch;
use Mpietrucha\Utility\Latch\Contracts\AdapterInterface;
use Mpietrucha\Utility\Latch\Contracts\BuilderInterface;
use Mpietrucha\Utility\Latch\Contracts\LatchInterface;

class Builder implements BuilderInterface, CreatableInterface
{
    use Arrayable, Creatable;

    protected ?AdapterInterface $adapter = null;

    /**
     * Create a new latch builder for the given indicator.
     */
    public function __construct(protected string $indicator)
    {
    }

    /**
     * Create a new builder instance for the given indicator.
     */
    public static function indicator(string $indicator): static
    {
        return static::create($indicator);
    }

    /**
     * Convert the builder configuration to an array.
     */
    final public function toArray(): array
    {
        return [
            $this->indicator,
            $this->adapter,
        ];
    }

    /**
     * Set the adapter to use for the latch.
     */
    public function adapter(AdapterInterface $adapter): static
    {
        $this->adapter = $adapter;

        return $this;
    }

    /**
     * Build and return the configured latch instance.
     */
    public function build(): LatchInterface
    {
        return Latch::create(...) |> $this->toCollection()->pipeSpread(...);
    }
}
