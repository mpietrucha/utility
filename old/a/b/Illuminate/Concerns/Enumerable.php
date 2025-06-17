<?php

namespace Mpietrucha\Utility\Illuminate\Concerns;

use Mpietrucha\Utility\Concerns\Creatable;

trait Enumerable
{
    use Creatable, InteractsWithCollection;

    public function toArray(): array
    {
        return parent::toArray();
    }

    public function all(): array
    {
        return parent::all();
    }
}
