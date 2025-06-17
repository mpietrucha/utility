<?php

namespace Mpietrucha\Utility\Exception\Contracts;

interface ThrowableInterface extends BuilderInterface
{
    public function throw(): void;
}
