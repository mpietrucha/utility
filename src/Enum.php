<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Concerns\Compatible;
use Mpietrucha\Utility\Contracts\CompatibleInterface;
use Mpietrucha\Utility\Enums\Contracts\InteractsWithEnumInterface;

abstract class Enum implements CompatibleInterface
{
    use Compatible;

    /**
     * @phpstan-assert-if-true class-string<\Mpietrucha\Utility\Enums\Contracts\InteractsWithEnumInterface> $input
     */
    protected static function compatibility(mixed $input): bool
    {
        $evaluation = Instance::is(...) |> Value::attempt(...);

        return $evaluation->eval([
            $input,
            InteractsWithEnumInterface::class,
        ])->boolean();
    }
}
