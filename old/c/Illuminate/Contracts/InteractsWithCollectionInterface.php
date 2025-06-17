<?php

namespace Mpietrucha\Utility\Illuminate\Contracts;

use Mpietrucha\Utility\Illuminate\Collection;
use Mpietrucha\Utility\Illuminate\LazyCollection;

interface InteractsWithCollectionInterface
{
    public function all(): array;

    public function collect(): Collection;

    public function lazy(): LazyCollection;
}
