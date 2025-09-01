<?php

namespace Mpietrucha\Fork\Larastan;

use Mpietrucha\Utility\Fork\Contracts\BodyInterface;
use Mpietrucha\Utility\Fork\Transformer;

class HigherOrderCollectionProxyExtension extends Transformer
{
    public function class(): string
    {
        return \Larastan\Larastan\Methods\HigherOrderCollectionProxyExtension::class;
    }

    public function transform(BodyInterface $body): void
    {
        $body->line(8)->set('use Fork\Larastan\Larastan\Support\HigherOrderCollectionProxyHelper;');
    }
}
