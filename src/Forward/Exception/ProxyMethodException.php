<?php

namespace Mpietrucha\Utility\Forward\Exception;

use Mpietrucha\Utility\Instance;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Throwable\RuntimeException;

class ProxyMethodException extends RuntimeException
{
    public function configure(string $method, object|string $instance): void
    {
        $instance = Instance::namespace($instance) |> Normalizer::string(...);

        $this->align(3);

        $this->message('Call to %s::%s() method is prohibited', $instance, $method);
    }
}
