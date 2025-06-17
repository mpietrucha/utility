<?php

namespace Mpietrucha\Utility\Contracts;

interface ArrayableInterface extends \Illuminate\Contracts\Support\Arrayable
{
    public function toArray(): array;
}
