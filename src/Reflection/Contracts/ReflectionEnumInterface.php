<?php

namespace Mpietrucha\Utility\Reflection\Contracts;

/**
 * @phpstan-require-extends \ReflectionEnum
 */
interface ReflectionEnumInterface extends InteractsWithReflectionInterface
{
    public function isNotBacked(): bool;
}
