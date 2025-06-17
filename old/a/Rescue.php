<?php

namespace Mpietrucha\Utility;

use Throwable;

abstract class Rescue extends Value
{
    public static function eval(mixed $value, array $arguments): array
    {
        $response = $throwable = null;

        try {
            $response = parent::eval($value, $arguments);
        } catch (Throwable $throwable) {
        }

        return [$response, $throwable];
    }
}
