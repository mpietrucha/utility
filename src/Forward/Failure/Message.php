<?php

namespace Mpietrucha\Utility\Forward\Failure;

use Mpietrucha\Utility\Str;
use Mpietrucha\Utility\Type;

abstract class Message
{
    public static function get(string $namespace, string $method): string
    {
        return Str::sprintf('%s::%s', $namespace, $method);
    }

    public static function build(string $message, string $from, string $to): string
    {
        return Str::replace($from, $to, $message);
    }
}
