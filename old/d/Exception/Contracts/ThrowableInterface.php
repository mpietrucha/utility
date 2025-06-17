<?php

namespace Mpietrucha\Utility\Exception\Contracts;

interface ThrowableInterface extends TransformerInterface
{
    public function throw(): void;
}
