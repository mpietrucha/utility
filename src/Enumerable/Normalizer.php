<?php

namespace Mpietrucha\Utility\Enumerable;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Forward\Concerns\Forwardable;
use Mpietrucha\Utility\Normalizer as Adapter;
use Mpietrucha\Utility\Str;

/**
 * @template TKey of array-key
 * @template TValue
 *
 * @mixin \Mpietrucha\Utility\Type
 */
class Normalizer implements CreatableInterface
{
    use Creatable, Forwardable;

    /**
     * @param  \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<TKey, TValue>  $collection
     */
    public function __construct(protected EnumerableInterface $collection)
    {
    }

    /**
     * @param  array<int, mixed>  $arguments
     */
    public function __call(string $method, array $arguments): EnumerableInterface
    {
        $method = Str::singular($method);

        return $this->proxy(Adapter::class)->$method(...) |> $this->collection()->map(...);
    }

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<TKey, TValue> $collection
     */
    protected function collection(): EnumerableInterface
    {
        return $this->collection;
    }
}
