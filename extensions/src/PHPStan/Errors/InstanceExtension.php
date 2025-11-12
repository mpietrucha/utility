<?php

namespace Mpietrucha\Extensions\PHPStan\Errors;

use Mpietrucha\Extensions\PHPStan\Concerns\InteractsWithError;
use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Data;
use Mpietrucha\Utility\Instance\Method;
use Mpietrucha\Utility\Instance\Path;
use Mpietrucha\Utility\Str;
use Mpietrucha\Utility\Stringable;
use Mpietrucha\Utility\Type;
use PhpParser\Node;
use PHPStan\Analyser\Error;
use PHPStan\Analyser\IgnoreErrorExtension;
use PHPStan\Analyser\Scope;

/**
 * @internal
 */
final class InstanceExtension implements IgnoreErrorExtension
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
            'return.type',
            'class.notFound',
            MethodExtension::identifiers(),
        ] |> Arr::flatten(...);
    }

    /**
     * Determine if the given error should be ignored.
     */
    public function shouldIgnore(Error $error, Node $node, Scope $scope): bool
    {
        if ($this->interactsWithIdentifier($error, 'return.type')) {
            return $this->interactsWithReturnType($error);
        }

        if ($this->interactsWithIdentifier($error, 'class.notFound')) {
            return $this->interactsWithInstance($error);
        }

        return $this->interactsWithIdentifiers($error) && $this->interactsWithVariable($error, $node);
    }

    /**
     * Check if the error relates to return type validation.
     */
    protected function interactsWithReturnType(Error $error): bool
    {
        $type = $this->returnType($error);

        $content = $this->pattern("*, *$type::class");

        return $this->interactsWithFileContent($error, $content);
    }

    /**
     * Check if the error relates to instance class resolution.
     */
    protected function interactsWithInstance(Error $error): bool
    {
        $instance = $this->instance($error);

        $content = $this->pattern("*$instance*");

        return $this->interactsWithFileContent($error, $content);
    }

    /**
     * Check if the error relates to a variable interaction.
     */
    protected function interactsWithVariable(Error $error, Node $node): bool
    {
        $variable = $this->variable($node);

        if (Type::null($variable)) {
            return false;
        }

        $content = $this->pattern("$$variable, *");

        return $this->interactsWithFileContent($error, $content);
    }

    /**
     * Build the pattern to match against file content.
     */
    protected function pattern(string $content): string
    {
        return Str::sprintf('*Instance::*(%s)*', $content);
    }

    /**
     * Extract the return type from the error message.
     */
    protected function returnType(Error $error): string
    {
        return $this->getErrorMessage($error)->between('should return', 'but') |> self::normalize(...);
    }

    /**
     * Extract the instance class name from the error message.
     */
    protected function instance(Error $error): string
    {
        $error = $this->getErrorMessage($error);

        return match (true) {
            $error->contains('unknown') => $error->between('unknown class', '.'),
            default => $error->between('Class', 'not found')
        } |> self::normalize(...);
    }

    /**
     * Extract the variable name from the node.
     */
    protected function variable(Node $node): ?string
    {
        return match (true) {
            Method::exists($node, 'getVar') => Data::get($node->getVar(), 'name'),
            default => Data::get($node, 'var.name')
        };
    }

    /**
     * Normalize the namespace by extracting the class name.
     */
    protected static function normalize(Stringable $namespace): string
    {
        return Path::name(...) |> $namespace->before('|')
            ->before('<')
            ->trim()
            ->pipe(...);
    }
}
