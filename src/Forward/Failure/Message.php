<?php

namespace Mpietrucha\Utility\Forward\Failure;

use Mpietrucha\Utility\Str;

abstract class Message
{
    /**
     * Format a method reference as a fully-qualified method string.
     */
    public static function get(string $namespace, string $method): string
    {
        return Str::sprintf('%s::%s', $namespace, $method);
    }

    /**
     * Replace the original method reference with the forwarded method reference in an error message.
     */
    public static function build(string $message, string $from, string $to): string
    {
        return Str::replace($from, $to, $message);
    }
}
