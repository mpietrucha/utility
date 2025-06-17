<?php

namespace Mpietrucha\Utility\Forward\Contracts;

interface BridgeInterface extends ForwardInterface
{
    public static function method(string $method): BridgeInterface;

    public function source(): string;

    public function destination(): string;
}
