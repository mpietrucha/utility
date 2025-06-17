<?php

namespace Mpietrucha\Utility\Forward\Concerns;

use Mpietrucha\Utility\Forward;
use Mpietrucha\Utility\Forward\Contracts\ForwardInterface;
use Mpietrucha\Utility\Forward\Contracts\ProxyInterface;

trait Forwardable
{
    protected function proxy(null|object|string $destination = null, ?string $method = null): ProxyInterface
    {
        return $this->forward($destination, $method)->proxy();
    }

    protected function forward(null|object|string $destination = null, ?string $method = null): ForwardInterface
    {
        $destination ??= $this;

        return Forward::create($destination, $this, $method);
    }
}
