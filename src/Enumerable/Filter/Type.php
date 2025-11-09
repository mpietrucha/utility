<?php

namespace Mpietrucha\Utility\Enumerable\Filter;

use Mpietrucha\Utility\Type as Adapter;

class Type extends None
{
    /**
     * Check if the current value matches the given type.
     */
    protected function get(mixed $value): bool
    {
        return Adapter::is($this->value(), $value);
    }
}
