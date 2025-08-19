<?php

namespace Mpietrucha\Utility\Enumerable;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Forward\Concerns\Forwardable;
use Mpietrucha\Utility\Normalizer as Adapter;
use Mpietrucha\Utility\Str;

class Normalizer implements CreatableInterface
{
    use Creatable, Forwardable;

    public function __construct(protected EnumerableInterface $collection)
    {
    }

    public function __call(string $method, array $arguments): EnumerableInterface
    {
        $method = Str::singular($method);

        return $this->proxy(Adapter::class)->$method(...) |> $this->collection()->map(...);
    }

    protected function collection(): EnumerableInterface
    {
        return $this->collection;
    }
}
