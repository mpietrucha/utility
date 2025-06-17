<?php

namespace Mpietrucha\Utility\Illuminate\Concerns;

use Mpietrucha\Utility\Illuminate\Collection;
use Mpietrucha\Utility\Illuminate\LazyCollection;

trait InteractsWithCollection
{
    public function all(): array
    {
        return [];
    }

    public function collect(): Collection
    {
        return Collection::create($this->all());
    }

    public function lazy(): LazyCollection
    {
        return LazyCollection::create($this->all(...));
    }
}
