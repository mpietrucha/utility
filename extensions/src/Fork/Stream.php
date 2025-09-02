<?php

namespace Mpietrucha\Extensions\Fork;

use Mpietrucha\Utility\Fork\Contracts\BodyInterface;
use Mpietrucha\Utility\Fork\Contracts\SectionInterface;
use Mpietrucha\Utility\Fork\Transformer;

class Stream extends Transformer
{
    public function class(): string
    {
        return \Nyholm\Psr7\Stream::class;
    }

    public function transform(BodyInterface $body): void
    {
        $body->line(14)->clear();

        $body->line(21)->replace('private', 'protected');

        $body->line(60) |> $this->exception(...);

        $body->line(77)->replace('create', 'build');

        $body->line(77)->replace('StreamInterface', 'static');

        $body->line(95) |> $this->exception(...);

        $body->line(98)->replace('self', 'static');

        $body->line(133)->replace('private', 'protected');
    }

    protected function exception(SectionInterface $section): void
    {
        $section->replace('Stream', "' . static::class . '");
    }
}
