<?php

declare(strict_types=1);

namespace Mpietrucha\PHPStan\Errors;

use Mpietrucha\PHPStan\Concerns\InteractsWithError;
use Mpietrucha\Utility\Str;
use Mpietrucha\Utility\Stringable;
use PhpParser\Node;
use PHPStan\Analyser\Error;
use PHPStan\Analyser\IgnoreErrorExtension;
use PHPStan\Analyser\Scope;

/**
 * @internal
 */
final class PropertyExtension implements IgnoreErrorExtension
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
            'property.notFound',
            'staticProperty.notFound',
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
        $property = $this->property($error);

        return Str::sprintf('*Property::*exists(*, *%s*)*', $property);
    }

    /**
     * Extract the property name from the error message.
     */
    protected function property(Error $error): Stringable
    {
        return $this->getErrorMessage($error)->between('::$', '.');
    }
}
