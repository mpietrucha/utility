<?php

namespace Mpietrucha\Utility\Concerns;

trait Uninstanceable
{
    /**
     * Prevent instantiation of this class.
     */
    final protected function __construct()
    {
    }
}
