<?php

namespace Mpietrucha\Extensions\Fork\Larastan;

class HigherOrderCollectionProxyPropertyExtension extends HigherOrderCollectionProxyExtension
{
    /**
     * Get the fully qualified class name to be transformed.
     */
    public function class(): string
    {
        return \Larastan\Larastan\Properties\HigherOrderCollectionProxyPropertyExtension::class;
    }
}
