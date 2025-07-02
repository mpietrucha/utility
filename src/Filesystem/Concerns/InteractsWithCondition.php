<?php

namespace Mpietrucha\Utility\Filesystem\Concerns;

use Mpietrucha\Utility\Filesystem\Condition\Filesystem;
use Mpietrucha\Utility\Forward\Context;
use Mpietrucha\Utility\Forward\Contracts\ContextInterface;

/**
 * @internal
 *
 * @template TCondition of object
 */
trait InteractsWithCondition
{
    /**
     * Create a context that succeeds when the condition is met.
     *
     * @return \Mpietrucha\Utility\Forward\Context<TCondition>
     */
    public static function is(): ContextInterface
    {
        return Context::is(static::condition());
    }

    /**
     * Create a context that succeeds when the condition is not met.
     *
     * @return \Mpietrucha\Utility\Forward\Context<TCondition>
     */
    public static function not(): ContextInterface
    {
        return Context::not(static::condition());
    }

    /**
     * Get the condition instance used by this class.
     *
     * @return TCondition
     */
    abstract protected static function condition(): Filesystem;
}
