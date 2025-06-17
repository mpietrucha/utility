<?php

namespace Mpietrucha\Utility\Contracts;

use Mpietrucha\Utility\Forward\Contracts\TappableProxyInterface;

interface TappableInterface
{
    public function tap(): TappableInterface|TappableProxyInterface;
}
