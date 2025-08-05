<?php

namespace Mpietrucha\Fork;

use Mpietrucha\Utility\Fork\Contracts\ContentInterface;
use Mpietrucha\Utility\Fork\Transformer;

class HigherOrderCollectionProxyHelper extends Transformer
{
    public function class(): string
    {
        return Larastan\Larastan\Support\HigherOrderCollectionProxyHelper::class;
    }

    public function transform(ContentInterface $content): void
    {
    }
}
