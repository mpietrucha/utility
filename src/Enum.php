<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Concerns\Compatible;
use Mpietrucha\Utility\Contracts\CompatibleInterface;
use Mpietrucha\Utility\Enums\Contracts\InteractsWithEnumInterface;

abstract class Enum implements CompatibleInterface
{
    use Compatible;

    protected static function compatibility(mixed $input): bool
    {
        $evaluation = Instance::is(...) |> Value::attempt(...);

        return $evaluation->eval([
            $input,
            InteractsWithEnumInterface::class,
        ])->boolean();
    }
}
