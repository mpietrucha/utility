<?php

namespace Mpietrucha\Utility\Contracts;

use Mpietrucha\Utility\Forward\Contracts\PassInterface;

interface PassableInterface
{
    /**
     * Create a Pass proxy that wraps the current instance with the given evaluable value.
     */
    public function pass(mixed $evaluable): PassInterface;
}
