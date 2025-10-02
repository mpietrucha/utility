<?php

namespace Mpietrucha\Utility\Error\Handler;

use Mpietrucha\Utility\Value;

class Runtime extends None
{
    public function __construct(protected object $adapter, protected bool $supported = false, protected mixed $capturable = null)
    {
    }

    public function adapter(): object
    {
        return $this->adapter;
    }

    public function supported(): bool
    {
        return $this->supported;
    }

    public function capture(): void
    {
        $evaluation = $this->capturable() |> Value::for(...);

        [$this->adapter(), $this->supported(), $this] |> $evaluation->eval(...);
    }

    protected function capturable(): mixed
    {
        return $this->capturable;
    }
}
