<?php

namespace Mpietrucha\Utility\Contracts;

interface TappableInterface
{
    public function tap(mixed $tap): self;
}
