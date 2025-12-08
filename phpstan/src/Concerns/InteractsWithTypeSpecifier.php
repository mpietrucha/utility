<?php

namespace Mpietrucha\PHPStan\Concerns;

use PHPStan\Analyser\TypeSpecifier;

/**
 * @phpstan-require-implements \PHPStan\Analyser\TypeSpecifierAwareExtension
 */
trait InteractsWithTypeSpecifier
{
    protected TypeSpecifier $specifier;

    public function setTypeSpecifier(TypeSpecifier $specifier): void
    {
        $this->specifier = $specifier;
    }

    protected function specifier(): TypeSpecifier
    {
        return $this->specifier;
    }
}
