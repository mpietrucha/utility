<?php

namespace Mpietrucha\Utility\Value;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Type;
use Mpietrucha\Utility\Value\Contracts\EvaluationInterface;

class Evaluation implements CreatableInterface, EvaluationInterface
{
    use Creatable;

    public function __construct(protected mixed $evaluable)
    {
    }

    public function __invoke(mixed ...$arguments): mixed
    {
        return $this->eval($arguments);
    }

    final public function evaluable(): mixed
    {
        return $this->evaluable;
    }

    public function supported(): bool
    {
        return Type::callable($this->evaluable());
    }

    final public function unsupported(): bool
    {
        return Normalizer::not($this->supported());
    }

    public function get(mixed ...$arguments): mixed
    {
        return $this->eval($arguments);
    }

    public function eval(array $arguments): mixed
    {
        if ($this->unsupported()) {
            return $this->evaluable();
        }

        return $this->evaluable()(...$arguments);
    }
}
