<?php

namespace Mpietrucha\Utility\Enumerable\Filter;

use Mpietrucha\Utility\Type as Adapter;

class Type extends None
{
    protected function get(mixed $value): bool
    {
        return Adapter::is($this->value(), $value);
    }
}
