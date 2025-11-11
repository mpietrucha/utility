<?php

namespace Mpietrucha\Extensions\Fork;

use Mpietrucha\Utility\Fork\Contracts\ContentInterface;
use Mpietrucha\Utility\Fork\Transformer;
use Mpietrucha\Utility\Str;

class Stream extends Transformer
{
    /**
     * Get the fully qualified class name to be transformed.
     */
    public function class(): string
    {
        return \Nyholm\Psr7\Stream::class;
    }

    /**
     * Transform the stream class by modifying visibility and exception handling.
     */
    public function transform(ContentInterface $content): void
    {
        $content->line(14)->clear();

        $content->line(21)->replace('private', 'protected');

        $this->exception('Stream body must be a resource') |> $content->line(60)->set(...);

        $content->line(77)->replace('StreamInterface', 'static');

        $this->exception('Stream body must be a resource, string, or StreamInterface::class') |> $content->line(95)->set(...);

        $content->line(98)->replace('self', 'static');

        $content->line(133)->replace('private', 'protected');
    }

    /**
     * Generate an exception string with the given message.
     */
    protected function exception(string $message): string
    {
        return Str::sprintf('throw new \InvalidArgumentException("%s");', $message);
    }
}
