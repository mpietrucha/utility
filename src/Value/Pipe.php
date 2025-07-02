<?php

namespace Mpietrucha\Utility\Value;

use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Value\Contracts\PipeInterface;

class Pipe extends Evaluation implements PipeInterface
{
    /**
     * Create a new pipe instance with the given value and evaluable callback.
     */
    public function __construct(protected mixed $value, mixed $evaluable)
    {
        parent::__construct($evaluable);
    }

    /**
     * Get the initial value that will be passed through the evaluable.
     */
    public function value(): mixed
    {
        return $this->value;
    }

    /**
     * Prepend the initial value to the argument list and invoke the evaluable,
     * returning the transformed result or the original value if the evaluable is unsupported.
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
