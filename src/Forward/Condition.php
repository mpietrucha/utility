<?php

namespace Mpietrucha\Utility\Forward;

use Mpietrucha\Utility\Forward\Contracts\MethodsInterface;
use Mpietrucha\Utility\Normalizer;

/**
 * @template T of object
 *
 * @extends \Mpietrucha\Utility\Forward\Proxy<T>
 */
class Condition extends Proxy
{
    public function __construct(protected object $conditionable, protected bool $condition, ?MethodsInterface $methods = null)
    {
        parent::__construct($conditionable, $methods);
    }

    public function __call(string $method, array $arguments): mixed
    {
        $conditionable = $this->conditionable;

        if (Normalizer::not($this->condition)) {
            return $conditionable;
        }

        return parent::__call($method, $arguments);
    }
}
