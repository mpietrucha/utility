<?php

namespace Mpietrucha\Utility\Forward;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Forward;
use Mpietrucha\Utility\Forward\Contracts\ForwardInterface;
use Mpietrucha\Utility\Forward\Contracts\MethodsInterface;
use Mpietrucha\Utility\Forward\Contracts\ProxyInterface;
use Mpietrucha\Utility\Forward\Proxy\Methods;

/**
 * @template T
 *
 * @property T $source
 *
 * @mixin T
 */
class Proxy implements CreatableInterface, ProxyInterface
{
    use Creatable;

    protected ForwardInterface $forward;

    /**
     * Create a new proxy instance for the given source and optional method restrictions.
     */
    public function __construct(protected object|string $source, protected ?MethodsInterface $methods = null)
    {
        $this->forward = Forward::wrap($source);
    }

    /**
     * Forward a dynamic method call to the destination, optionally validating it.
     */
    public function __call(string $method, array $arguments): mixed
    {
        $this->methods?->validate($method, $this->forward->destination());

        return $this->forward->eval($method, $arguments);
    }

    /**
     * Create a method restriction allowing only the specified methods.
     *
     * @param  string|array<int, string>  $methods
     */
    public static function allow(array|string $methods): MethodsInterface
    {
        return Methods::create()->allow($methods);
    }

    /**
     * Create a method restriction denying the specified methods.
     *
     * @param  string|array<int, string>  $methods
     */
    public static function deny(array|string $methods): MethodsInterface
    {
        return Methods::create()->deny($methods);
    }
}
