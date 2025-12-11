<?php

namespace Mpietrucha\Utility\Reflection;

use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Reflection\Concerns\InteractsWithReflection;
use Mpietrucha\Utility\Reflection\Contracts\ReflectionEnumInterface;
use ReflectionEnum;

/**
 * @extends \ReflectionEnum<\UnitEnum>
 */
class Enum extends ReflectionEnum implements ReflectionEnumInterface
{
    use InteractsWithReflection;

    final public function isNotBacked(): bool
    {
        return $this->isBacked() |> Normalizer::not(...);
    }
}
