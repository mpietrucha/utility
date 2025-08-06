<?php

namespace Mpietrucha\Fork;

use Mpietrucha\Utility\Fork\Contracts\SourceInterface;
use Mpietrucha\Utility\Fork\Transformer;

class Stream extends Transformer
{
    public function class(): string
    {
        return \Nyholm\Psr7\Stream::class;
    }

    public function transform(SourceInterface $source): void
    {

    }
}
