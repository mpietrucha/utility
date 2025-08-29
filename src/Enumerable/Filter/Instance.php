<?php

namespace Mpietrucha\Utility\Enumerable\Filter;

use Mpietrucha\Utility\Instance as Adapter;

class Instance extends None
{
    protected function get(mixed $value): bool
    {
        return Adapter::is($this->value(), $value);
    }
}
