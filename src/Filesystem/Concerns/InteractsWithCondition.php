<?php

namespace Mpietrucha\Utility\Filesystem\Concerns;

use Mpietrucha\Utility\Filesystem\Condition;
use Mpietrucha\Utility\Forward\Context;
use Mpietrucha\Utility\Forward\Contracts\ContextInterface;

/**
 * @internal
 */
trait InteractsWithCondition
{
    /**
     * Create a context that succeeds when the condition is met.
     *
     * @return \Mpietrucha\Utility\Forward\Context<\Mpietrucha\Utility\Filesystem\Condition>
     */
    public static function is(): ContextInterface
    {
        return Context::is(static::condition());
    }

    /**
     * Create a context that succeeds when the condition is not met.
     *
     * @return \Mpietrucha\Utility\Forward\Context<\Mpietrucha\Utility\Filesystem\Condition>
     */
    public static function not(): ContextInterface
    {
        return Context::not(static::condition());
    }

    /**
     * Get the condition instance used by this class.
     */
    abstract protected static function condition(): Condition;
}
