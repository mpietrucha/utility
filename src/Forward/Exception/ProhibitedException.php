<?php

namespace Mpietrucha\Utility\Forward\Exception;

use Mpietrucha\Utility\Throwable\RuntimeException;

class ProhibitedException extends RuntimeException
{
    public function configure(string $instance, string $method): string
    {
        $this->align(3);

        return 'Call to %s::%s() method is prohibited';
    }
}
