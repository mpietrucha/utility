<?php

namespace Mpietrucha\Extensions\Fork;

use Mpietrucha\Utility\Fork\Contracts\BodyInterface;
use Mpietrucha\Utility\Fork\Transformer;
use Mpietrucha\Utility\Str;

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

        $this->exception('Stream body must be a resource') |> $body->line(60)->set(...);

        $body->line(77)->replace('StreamInterface', 'static');

        $this->exception('Stream body must be a resource, string, or StreamInterface::class') |> $body->line(95)->set(...);

        $body->line(98)->replace('self', 'static');

        $body->line(133)->replace('private', 'protected');
    }

    protected function exception(string $message): string
    {
        return Str::sprintf('throw new \InvalidArgumentException("%s");', $message);
    }
}
