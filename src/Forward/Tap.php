<?php

namespace Mpietrucha\Utility\Forward;

use Mpietrucha\Utility\Contracts\TappableInterface;
use Mpietrucha\Utility\Forward;

class Tap extends Proxy
{
    public function __construct(protected TappableInterface $tap)
    {
        return parent::__construct(Forward::create($tap));
    }

    public function __call(string $method, array $arguments): TappableInterface
    {
        parent::__call($method, $arguments);

        return $this->tap;
    }
}
