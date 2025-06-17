<?php

namespace Mpietrucha\Utility\Contracts;

use Mpietrucha\Utility\Forward\Contracts\TapProxyInterface;

interface TappableInterface
{
    public function tap(): TappableInterface|TapProxyInterface;
}
