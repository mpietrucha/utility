<?php

namespace Mpietrucha\Utility\Value;

use Mpietrucha\Utility;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Throwable\Contracts\ThrowableInterface;
use Mpietrucha\Utility\Type;
use Mpietrucha\Utility\Value\Contracts\ResultInterface;
use Throwable;

class Result implements CreatableInterface, ResultInterface
{
    use Creatable;

    public function __construct(protected mixed $value, protected ?Throwable $failure)
    {
    }

    public function value(): mixed
    {
        return $this->value;
    }

    public function failure(): ?Throwable
    {
        return $this->failure;
    }

    public function throwable(): ?ThrowableInterface
    {
        if ($this->succeeded()) {
            return null;
        }

        return Utility\Throwable::create($this->failure());
    }

    public function succeeded(): bool
    {
        return Type::null($this->failure());
    }

    public function failed(): bool
    {
        return Normalizer::not($this->succeeded());
    }
}
