<?php

declare(strict_types=1);

namespace Mpietrucha\Extensions\PHPStan\Errors;

use Mpietrucha\Extensions\PHPStan\Concerns\InteractsWithError;
use PhpParser\Node;
use PHPStan\Analyser\Error;
use PHPStan\Analyser\IgnoreErrorExtension;
use PHPStan\Analyser\Scope;

/**
 * @internal
 */
final class PipelineExtension implements IgnoreErrorExtension
{
    use InteractsWithError;

    public function shouldIgnore(Error $error, Node $node, Scope $scope): bool
    {
        if ($this->interactsWithIdentifier($error, 'expr.resultUnused') === false) {
            return false;
        }

        return $this->interactsWithMessage($error, '*|>*(...)*');
    }
}
