<?php

namespace Mpietrucha\Utility\Forward;

use Mpietrucha\Utility\Contracts\TappableInterface;
use Mpietrucha\Utility\Forward;
use Mpietrucha\Utility\Forward\Contracts\TapInterface;

class Tap extends Proxy implements TapInterface
{
    public function __construct(protected TappableInterface $tappable)
    {
        $forward = Forward::create($tappable);

        parent::__construct($forward);
    }

    public function __call(string $method, array $arguments): TappableInterface
    {
        parent::__call($method, $arguments);

        return $this->tappable;
    }
}
