<?php

namespace Mpietrucha\Utility\Throwable\Contracts;

interface ThrowableInterface extends ReflectionInterface
{
    public function throw(): void;
}
