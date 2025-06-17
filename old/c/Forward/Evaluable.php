<?php

namespace Mpietrucha\Utility\Forward;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Forward\Contracts\EvaluableInterface;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Type;

class Evaluable implements CreatableInterface, EvaluableInterface
{
    use Creatable;

    public function __construct(protected object|string $source)
    {
    }

    public function __invoke(string $method, array $arguments): mixed
    {
        return match (true) {
            $this->instantiated() => $this->source()->$method(...$arguments),
            $this->uninstantiated() => $this->source()::$method(...$arguments),
        };
    }

    public function source(): object|string
    {
        return $this->source;
    }

    public function instantiated(): bool
    {
        return Type::object($this->source());
    }

    public function uninstantiated(): bool
    {
        return Normalizer::not($this->instantiated());
    }
}
