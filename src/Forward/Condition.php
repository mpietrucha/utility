<?php

namespace Mpietrucha\Utility\Forward;

use Mpietrucha\Utility\Forward\Contracts\MethodsInterface;
use Mpietrucha\Utility\Normalizer;

/**
 * @template TSource of object
 *
 * @extends \Mpietrucha\Utility\Forward\Proxy<TSource>
 */
class Condition extends Proxy
{
    /**
     * Create a new conditional proxy instance.
     */
    public function __construct(protected object $conditionable, protected bool $condition, ?MethodsInterface $methods = null)
    {
        parent::__construct($conditionable, $methods);
    }

    /**
     * Conditionally forward method calls based on the condition.
     */
    public function __call(string $method, array $arguments): mixed
    {
        $conditionable = $this->conditionable;

        if ($this->condition |> Normalizer::not(...)) {
            return $conditionable;
        }

        return parent::__call($method, $arguments);
    }
}
