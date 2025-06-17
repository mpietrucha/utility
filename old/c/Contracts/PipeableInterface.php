<?php

namespace Mpietrucha\Utility\Contracts;

interface PipeableInterface
{
    public function pipe(mixed $handler): mixed;
}
