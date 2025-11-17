<?php

declare(strict_types=1);

namespace Mpietrucha\PHPStan\Errors;

use Mpietrucha\PHPStan\Concerns\InteractsWithError;
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

    /**
     * Get the list of error identifiers this extension handles.
     *
     * @return list<string>
     */
    public static function identifiers(): array
    {
        return [
            'expr.resultUnused',
        ];
    }

    /**
     * Determine if the given error should be ignored.
     */
    public function shouldIgnore(Error $error, Node $node, Scope $scope): bool
    {
        if ($this->interactsWithIdentifiers($error) === false) {
            return false;
        }

        return $this->interactsWithMessage($error, '*|>*(...)*');
    }
}
