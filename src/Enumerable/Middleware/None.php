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

    public function __invoke(mixed $value, mixed $key): mixed
    {
        $handler = $this->handler();

        return $this->arguments($value, $key) |> Value::for($handler)->eval(...);
    }

    /**
     * @return array{0: mixed, 1: mixed}
     */
    public function arguments(mixed $value, mixed $key): array
    {
        return [
            $this->value($value, $key),
            $this->key($key, $value),
        ];
    }

    public function key(mixed $key, mixed $value): mixed
    {
        return $key;
    }

    public function value(mixed $value, mixed $key): mixed
    {
        return $value;
    }

    protected function handler(): mixed
    {
        return $this->handler;
    }
}
