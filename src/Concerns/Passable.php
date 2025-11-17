<?php

namespace Mpietrucha\Utility\Concerns;

use Mpietrucha\Utility\Forward\Contracts\PassInterface;
use Mpietrucha\Utility\Forward\Pass;

/**
 * @phpstan-require-implements \Mpietrucha\Utility\Contracts\PassableInterface
 */
trait Passable
{
    /**
     * Create a Pass proxy that forwards method calls to this instance while always returning the specified value.
     *
     * @return \Mpietrucha\Utility\Forward\Pass<static>
     */
    public function pass(mixed $evaluable): PassInterface
    {
        return Pass::create($this, $evaluable);
    }
}
