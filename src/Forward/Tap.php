<?php

namespace Mpietrucha\Utility\Forward;

use Mpietrucha\Utility\Contracts\TappableInterface;
use Mpietrucha\Utility\Forward\Contracts\MethodsInterface;
use Mpietrucha\Utility\Forward\Contracts\TapInterface;

/**
 * @template T of object
 *
 * @extends \Mpietrucha\Utility\Forward\Proxy<T>
 */
class Tap extends Proxy implements TapInterface
{
    /**
     * Create a new tap proxy for the given tappable target.
     */
    public function __construct(protected TappableInterface $tappable, ?MethodsInterface $methods = null)
    {
        parent::__construct($tappable, $methods);
    }

    /**
     * Forward the method call to the tappable and return the original tappable instance.
     */
    public function __call(string $method, array $arguments): TappableInterface
    {
        parent::__call($method, $arguments);

        return $this->tappable;
    }
}
