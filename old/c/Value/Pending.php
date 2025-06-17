<?php

namespace Mpietrucha\Utility\Value;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Type;
use Mpietrucha\Utility\Value\Contracts\PendingInterface;

class Pending implements CreatableInterface, PendingInterface
{
    use Creatable;

    public function __construct(protected mixed $evaluable)
    {
    }

    final public function __invoke(mixed ...$arguments): mixed
    {
        return $this->eval($arguments);
    }

    final public function evaluable(): mixed
    {
        return $this->evaluable;
    }

    public function valid(): bool
    {
        return Type::callable($this->evaluable());
    }

    final public function invalid(): bool
    {
        return Normalizer::not($this->valid());
    }

    final public function get(mixed ...$arguments): mixed
    {
        return $this->eval($arguments);
    }

    public function eval(array $arguments): mixed
    {
        return $this->invalid() ? $this->evaluable() : $this->evaluable()(...$arguments);
    }
}
