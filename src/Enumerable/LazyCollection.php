<?php

namespace Mpietrucha\Utility\Enumerable;

use Mpietrucha\Utility\Enumerable\Concerns\Enumerable;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Value;

/**
 * @template TKey of array-key
 *
 * @template-covariant TValue
 *
 * @extends \Illuminate\Support\LazyCollection<TKey, TValue>
 *
 * @implements \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<TKey, TValue>
 *
 * @phpstan-ignore-next-line class.missingImplements
 */
class LazyCollection extends \Illuminate\Support\LazyCollection implements EnumerableInterface
{
    /**
     * @use \Mpietrucha\Utility\Enumerable\Concerns\Enumerable<TKey, TValue>
     */
    use Enumerable;

    /**
     * Initialize a lazy collection by calling a handler with the given arguments.
     */
    public static function initialize(mixed $handler, mixed ...$arguments): static
    {
        return Value::bind($handler, $arguments) |> static::create(...);
    }
}
