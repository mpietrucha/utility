<?php

namespace Mpietrucha\Utility\Value;

use Mpietrucha\Utility\Value\Contracts\AttemptInterface;
use Mpietrucha\Utility\Value\Contracts\RescueInterface;
use Throwable;

class Rescue extends Pending implements RescueInterface
{
    public function eval(array $arguments): AttemptInterface
    {
        return Attempt::create(...$this->raw($arguments));
    }

    public function raw(array $arguments): array
    {
        $response = $throwable = null;

        try {
            $response = parent::eval($arguments);
        } catch (Throwable $throwable) {
        }

        return [$response, $throwable];
    }
}
