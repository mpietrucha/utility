<?php

namespace Mpietrucha\Utility\Value;

use Mpietrucha\Utility\Illuminate\Arr;
use Mpietrucha\Utility\Value\Contracts\PipeInterface;

class Pipe extends Evaluation implements PipeInterface
{
    public function __construct(protected mixed $value, mixed $evaluable)
    {
        parent::__construct($evaluable);
    }

    public function value(): mixed
    {
        return $this->value;
    }

    /**
        @param array<mixed> $arguments
     */
    public function eval(array $arguments): mixed
    {
        $arguments = Arr::prepend($arguments, $value = $this->value());

        if ($this->unsupported()) {
            return $value;
        }

        return parent::eval($arguments);
    }
}
