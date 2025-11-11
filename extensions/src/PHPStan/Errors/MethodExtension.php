<?php

declare(strict_types=1);

namespace Mpietrucha\Extensions\PHPStan\Errors;

use Mpietrucha\Extensions\PHPStan\Concerns\InteractsWithError;
use Mpietrucha\Utility\Str;
use Mpietrucha\Utility\Stringable;
use PhpParser\Node;
use PHPStan\Analyser\Error;
use PHPStan\Analyser\IgnoreErrorExtension;
use PHPStan\Analyser\Scope;

/**
 * @internal
 */
final class MethodExtension implements IgnoreErrorExtension
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
            'method.notFound',
            'staticMethod.notFound',
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

        return $this->interactsWithFileContent($error, $this->content($error));
    }

    /**
     * Build the pattern to match against file content.
     */
    protected function content(Error $error): string
    {
        $method = $this->method($error);

        return Str::sprintf('*Method::*exists(*, *%s*)*', $method);
    }

    /**
     * Extract the method name from the error message.
     */
    protected function method(Error $error): Stringable
    {
        return $this->getErrorMessage($error)->between('::', '().');
    }
}
