<?php

namespace Mpietrucha\Utility\Contracts;

use Mpietrucha\Utility\Forward\Contracts\ProxyInterface;

interface TappableInterface
{
    public function tap(): TappableInterface|ProxyInterface;
}
