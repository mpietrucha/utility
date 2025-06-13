<?php

namespace Mpietrucha\Utility\Value;

use Mpietrucha\Utility\Value\Contracts\AttemptInterface;
use Mpietrucha\Utility\Value\Contracts\ResultInterface;
use Throwable;

class Attempt extends Evaluation implements AttemptInterface
{
    public function __invoke(mixed ...$arguments): ResultInterface
    {
        return parent::__invoke(...$arguments);
    }

    public function get(mixed ...$arguments): ResultInterface
    {
        return parent::get(...$arguments);
    }

    public function eval(array $arguments): ResultInterface
    {
        $value = $failure = null;

        try {
            $value = parent::eval($arguments);
        } catch (Throwable $failure) {
        }

        return Result::create($value, $failure);
    }
}
