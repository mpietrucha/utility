<?php

namespace Mpietrucha\Utility\Value;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Value\Contracts\AttemptInterface;
use Throwable;

class Attempt implements AttemptInterface, CreatableInterface
{
    use Creatable;

    public function __construct(protected mixed $response, protected ?Throwable $throwable)
    {
    }

    public function response(): mixed
    {
        return $this->response;
    }

    public function throwable(): ?Throwable
    {
        return $this->throwable;
    }

    public function succeeded(): bool
    {
        return Normalizer::not($this->throwable());
    }

    public function failed(): bool
    {
        return Normalizer::not($this->succeeded());
    }

    public function toArray(): array
    {
        return [$this->response(), $this->throwable(), $this->succeeded()];
    }
}
