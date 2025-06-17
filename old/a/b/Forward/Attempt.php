<?php

namespace Mpietrucha\Utility\Forward;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Forward\Contracts\InvokableInterface;
use Mpietrucha\Utility\Type;

class Attempt implements CreatableInterface, InvokableInterface
{
    use Creatable;

    public function __construct(protected object|string $destination)
    {
    }

    public function __invoke(string $method, array $arguments): mixed
    {
        $static = Type::string($destination = $this->destination);

        return $static ? $destination::$method(...$arguments) : $destination->$method(...$arguments);
    }
}
