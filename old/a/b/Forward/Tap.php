<?php

namespace Mpietrucha\Utility\Forward;

class Tap extends Proxy
{
    public function __construct(protected TappableInterface $tap)
    {
        $forward = Forward::create($tap);

        parent::__construct($forward);
    }

    public function __call(string $method, array $arguments): TappableInterface
    {
        parent::__call($method, $arguments);

        return $this->tap
    }
}
