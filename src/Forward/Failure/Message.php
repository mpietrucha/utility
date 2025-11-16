<?php

namespace Mpietrucha\Utility\Forward\Failure;

use Mpietrucha\Utility\Forward\Contracts\FailureInterface;
use Mpietrucha\Utility\Instance;
use Mpietrucha\Utility\Str;
use Mpietrucha\Utility\Type;

abstract class Message
{
    public static function to(FailureInterface $failure, string $method): string
    {
        $input = $failure->forward()->source();

        return static::get($input, $failure->forward()->method() ?? $method);
    }

    public static function from(FailureInterface $failure, string $method): string
    {
        $input = $failure->forward()->destination();

        return static::get($input, $method);
    }

    public static function get(object|string $input, string $method): string
    {
        $namespace = Instance::namespace($input);

        if (Type::null($namespace)) {
            return Str::none();
        }

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
