<?php

namespace Mpietrucha\Utility\Value;

use Mpietrucha\Utility\Illuminate\Arr;
use Mpietrucha\Utility\Value\Contracts\PipeInterface;

class Pipe extends Pending implements PipeInterface
{
    public function __construct(protected mixed $value, mixed $transformer)
    {
        parent::__construct($transformer);
    }

    public function transformer(): mixed
    {
        return $this->evaluable();
    }

    public function value(): mixed
    {
        return $this->value;
    }

    public function eval(array $arguments): mixed
    {
        $value = $this->value();

        $arguments = Arr::prepend($arguments, $value);

        return $this->invalid() ? $value : parent::eval($arguments);
    }
}
