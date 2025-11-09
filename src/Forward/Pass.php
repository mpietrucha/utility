<?php

namespace Mpietrucha\Utility\Forward;

use Mpietrucha\Utility\Contracts\PassableInterface;
use Mpietrucha\Utility\Forward\Contracts\MethodsInterface;
use Mpietrucha\Utility\Forward\Contracts\PassInterface;

/**
 * @template TSource of object
 *
 * @extends \Mpietrucha\Utility\Forward\Proxy<TSource>
 */
class Pass extends Proxy implements PassInterface
{
    /**
     * Create a new pass proxy for the given passable, storing the value to be returned after each call.
     */
    public function __construct(PassableInterface $passable, protected mixed $value, ?MethodsInterface $methods = null)
    {
        parent::__construct($passable, $methods);
    }

    /**
     * Forward the method call to the passable and return the stored value for fluent chaining.
     */
    public function __call(string $method, array $arguments): mixed
    {
        parent::__call($method, $arguments);

        return $this->value;
    }
}
