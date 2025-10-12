<?php

namespace Mpietrucha\Utility\Error;

use Mpietrucha\Utility\Concerns\Arrayable;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Error\Contracts\BuilderInterface;
use Mpietrucha\Utility\Error\Contracts\HandlerInterface;

class Builder implements BuilderInterface, CreatableInterface
{
    use Arrayable, Creatable;

    protected bool $supported = false;

    protected mixed $capturable = null;

    public function __construct(protected object $adapter)
    {
    }

    public static function adapter(object $adapter): static
    {
        return static::create($adapter);
    }

    final public function toArray(): array
    {
        return [
            $this->adapter,
            $this->supported,
            $this->capturable,
        ];
    }

    public function supported(bool $supported): static
    {
        $this->supported = $supported;

        return $this;
    }

    public function capture(mixed $capturable): static
    {
        $this->capturable = $capturable;

        return $this;
    }

    public function build(): HandlerInterface
    {
        return Handler\Runtime::create(...) |> $this->toCollection()->pipeSpread(...);
    }
}
