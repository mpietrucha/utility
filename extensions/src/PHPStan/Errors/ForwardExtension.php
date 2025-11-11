<?php

declare(strict_types=1);

namespace Mpietrucha\Extensions\PHPStan\Errors;

use Mpietrucha\Extensions\PHPStan\Concerns\InteractsWithError;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use PhpParser\Node;
use PHPStan\Analyser\Error;
use PHPStan\Analyser\IgnoreErrorExtension;
use PHPStan\Analyser\Scope;

/**
 * @internal
 */
final class ForwardExtension implements IgnoreErrorExtension
{
    use InteractsWithError;

    /** @var list<string> */
    protected static array $forwarders = [
        '*Value::*',
    ];

    /**
     * Determine if the given error should be ignored.
     */
    public function shouldIgnore(Error $error, Node $node, Scope $scope): bool
    {
        if ($this->interactsWithIdentifier($error, 'method.notFound')) {
            return $this->interactsWithProxy($error);
        }

        if ($this->interactsWithIdentifier($error, 'arguments.count') === false) {
            return false;
        }

        return $this->interactsWithForwarders($error);
    }

    /**
     * Check if the error relates to proxy interface methods.
     */
    protected function interactsWithProxy(Error $error): bool
    {
        return $this->interactsWithMessage($error, '*Mpietrucha\Utility\Forward\Contracts\ProxyInterface::*(*).');
    }

    /**
     * Check if the error matches known forwarder patterns.
     */
    protected function interactsWithForwarders(Error $error): bool
    {
        $forwarders = $this->getErrorFileContentLine($error) |> self::forwarders()->filter->fits(...);

        return $forwarders->containsOneItem();
    }

    /**
     * Get the collection of forwarder patterns.
     *
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, \Mpietrucha\Utility\Stringable>
     */
    protected static function forwarders(): EnumerableInterface
    {
        $forwarders = self::$forwarders |> Collection::create(...);

        return $forwarders->mapToStringables();
    }
}
