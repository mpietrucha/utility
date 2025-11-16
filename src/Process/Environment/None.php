<?php

namespace Mpietrucha\Utility\Process\Environment;

use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Process\Contracts\EnvironmentInterface;
use Mpietrucha\Utility\Process\Environment;
use Mpietrucha\Utility\Str;
use Mpietrucha\Utility\Utilizer\Concerns\Utilizable;

abstract class None implements EnvironmentInterface
{
    use Utilizable\Strings;

    public static function get(): array
    {
        return [static::name() => static::utilize() |> Str::nullWhenEmpty(...) ?? static::value()];
    }

    public static function default(): string
    {
        return Arr::get(Environment::default(), static::name(), Str::none());
    }
}
