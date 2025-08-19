<?php

namespace Mpietrucha\Utility\Fork\Transformer;

use Mpietrucha\Utility\Instance\FQN;
use Mpietrucha\Utility\Str;

class Normalizer
{
    public static function name(string $class): string
    {
        return FQN::name($class) |> Str::of('class %s')->sprintf(...);
    }

    public static function namespace(string $namespace): string
    {
        return FQN::namespace($namespace) |> Str::of('namespace %s;')->sprintf(...);
    }
}
