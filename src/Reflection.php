<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Reflection\Contracts\ReflectionInterface;
use ReflectionClass;

class Reflection extends ReflectionClass implements CreatableInterface, ReflectionInterface
{
    use Creatable;

    public static function deep(object|string $instance): static
    {
    }
}
