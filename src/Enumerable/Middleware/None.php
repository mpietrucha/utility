<?php

namespace Mpietrucha\Utility\Enumerable\Middleware;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Value;

abstract class None implements CreatableInterface
{
    use Creatable;

    public function __construct(protected mixed $handler)
    {
    }

    public function __invoke(mixed $value, int|string $key): mixed
    {
        $handler = $this->handler();

        return $this->arguments($value, $key) |> Value::for($handler)->eval(...);
    }

    /**
     * @return array{0: mixed, 1: mixed}
     */
    abstract public function arguments(mixed $value, int|string $key): array;

    protected function handler(): mixed
    {
        return $this->handler;
    }
}
