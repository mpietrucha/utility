<?php

namespace Mpietrucha\Utility\Enumerable\Middleware;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Value;

/**
 * @phpstan-import-type MixedArray from \Mpietrucha\Utility\Arr
 */
abstract class None implements CreatableInterface
{
    use Creatable;

    public function __construct(protected mixed $handler)
    {
    }

    public function __invoke(): mixed
    {
        $handler = $this->handler();

        return func_get_args() |> $this->arguments(...) |> Value::for($handler)->eval(...);
    }

    /**
     * @param  MixedArray  $arguments
     * @return MixedArray
     */
    public function arguments(array $arguments): array
    {
        return $arguments;
    }

    protected function handler(): mixed
    {
        return $this->handler;
    }
}
