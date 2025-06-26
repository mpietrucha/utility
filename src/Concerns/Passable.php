<?php

namespace Mpietrucha\Utility\Concerns;

use Mpietrucha\Utility\Forward\Contracts\PassInterface;
use Mpietrucha\Utility\Forward\Pass;

trait Passable
{
    /**
     * Create a Pass proxy wrapping the current instance with the given evaluable value,
     * enabling controlled method forwarding with a fixed return value.
     *
     * @return \Mpietrucha\Utility\Forward\Pass<static>
     */
    public function pass(mixed $evaluable): PassInterface
    {
        return Pass::create($this, $evaluable);
    }
}
