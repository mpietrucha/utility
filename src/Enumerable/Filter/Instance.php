<?php

namespace Mpietrucha\Utility\Enumerable\Filter;

use Mpietrucha\Utility\Instance as Adapter;

class Instance extends None
{
    /**
     * Check if the current value is an instance of the given class or interface.
     */
    protected function get(mixed $value): bool
    {
        return Adapter::is($this->value(), $value);
    }
}
