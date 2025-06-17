<?php

namespace Mpietrucha\Utility\Forward;

use Mpietrucha\Utility\Forward;
use Mpietrucha\Utility\Forward\Contracts\BridgeInterface;

class Bridge extends Forward implements BridgeInterface
{
    public function __construct(string $destination ?string $source = null, ?string $method = null)
    {
        parent::__construct($destination, $source, $method);
    }

    public static function method(string $method): self
    {
    }
}
