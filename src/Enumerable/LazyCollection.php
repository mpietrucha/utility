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
 */
class LazyCollection extends \Illuminate\Support\LazyCollection implements EnumerableInterface
{
    /**
     * @use \Mpietrucha\Utility\Enumerable\Concerns\Enumerable<TKey, TValue>
     */
    use Enumerable;

    public static function initialize(mixed $handler, mixed ...$arguments): static
    {
        $evaluable = Value::for($handler);

        return static::create(fn () => $evaluable->eval($arguments));
    }
}
