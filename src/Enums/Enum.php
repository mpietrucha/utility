<?php

namespace Mpietrucha\Utility\Enums;

use Mpietrucha\Utility\Concerns\Compatible;
use Mpietrucha\Utility\Contracts\CompatibleInterface;
use Mpietrucha\Utility\Enums\Contracts\InteractsWithEnumInterface;
use Mpietrucha\Utility\Instance;
use Mpietrucha\Utility\Value;

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
