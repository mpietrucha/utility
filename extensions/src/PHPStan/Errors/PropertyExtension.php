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
final class PropertyExtension implements IgnoreErrorExtension
{
    use InteractsWithError;

    /**
     * @return list<string>
     */
    public static function identifiers(): array
    {
        return [
            'property.notFound',
            'staticProperty.notFound',
        ];
    }

    public function shouldIgnore(Error $error, Node $node, Scope $scope): bool
    {
        if ($this->interactsWithIdentifiers($error) === false) {
            return false;
        }

        return $this->interactsWithFileContent($error, $this->content($error));
    }

    protected function content(Error $error): string
    {
        $property = $this->property($error);

        return Str::sprintf('*Property::*exists(*, *%s*)*', $property);
    }

    protected function property(Error $error): Stringable
    {
        return $this->getErrorMessage($error)->between('::$', '.');
    }
}
