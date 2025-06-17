<?php

namespace Mpietrucha\Utility\Illuminate\Concerns;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Illuminate\Collection;
use Mpietrucha\Utility\Illuminate\LazyCollection;

trait Enumerable
{
    use Creatable;

    public function toArray(): array
    {
        return parent::toArray();
    }

    public function collect(): Collection
    {
        return Collection::create($this->all());
    }

    public function lazy(): LazyCollection
    {
        return LazyCollection::create($this->all());
    }
}
