<?php

namespace Mpietrucha\Fork;

use Mpietrucha\Utility\Fork\Contracts\ContentInterface;
use Mpietrucha\Utility\Fork\Transformer;

class Stream extends Transformer
{
    public function class(): string
    {
        return \Nyholm\Psr7\Stream::class;
    }

    public function transform(ContentInterface $content): void
    {

    }
}
