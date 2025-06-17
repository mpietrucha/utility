<?php

namespace Mpietrucha\Utility\Exception\Contracts;

use Mpietrucha\Utility\Illuminate\Collection;

interface TransformerInterface extends InteractsWithThrowableInterface
{
    public function backtrace(): Collection;
}
