<?php

namespace Mpietrucha\Utility\Fork\Instance;

use Mpietrucha\Utility\Instance;
use Mpietrucha\Utility\Normalizer;

abstract class File
{
    public static function get(object|string $class): string
    {
        return Instance::file($class, Instance::LOAD) |> Normalizer::string(...);
    }
}
