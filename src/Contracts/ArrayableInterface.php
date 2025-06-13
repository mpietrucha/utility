<?php

namespace Mpietrucha\Utility\Contracts;

use Illuminate\Contracts\Support\Arrayable;

interface ArrayableInterface extends Arrayable
{
    public function toArray(): array;
}
