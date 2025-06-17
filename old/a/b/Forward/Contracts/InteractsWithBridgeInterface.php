<?php

namespace Mpietrucha\Utility\Forward\Contracts;

interface InteractsWithBridgeInterface
{
    public static function __callStatic(string $method, array $arguments): mixed;
}
