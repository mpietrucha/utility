<?php

namespace Mpietrucha\Fork\Larastan;

class HigherOrderCollectionProxyPropertyExtension extends HigherOrderCollectionProxyExtension
{
    public function class(): string
    {
        return \Larastan\Larastan\Properties\HigherOrderCollectionProxyPropertyExtension::class;
    }
}
