<?php

namespace Mpietrucha\Extensions\Fork\Larastan;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Fork\Contracts\ContentInterface;
use Mpietrucha\Utility\Fork\Transformer;
use Mpietrucha\Utility\Str;

class HigherOrderCollectionProxyHelper extends Transformer
{
    /**
     * Get the fully qualified class name to be transformed.
     */
    public function class(): string
    {
        return \Larastan\Larastan\Support\HigherOrderCollectionProxyHelper::class;
    }

    /**
     * Transform the class content by replacing the collection interface alias.
     */
    public function transform(ContentInterface $content): void
    {
        Str::sprintf('use %s as SupportCollection;', EnumerableInterface::class) |> $content->line(7)->set(...);
    }
}
