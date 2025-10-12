<?php

namespace Mpietrucha\Extensions\Fork\Larastan;

use Fork\Larastan\Larastan\Support\HigherOrderCollectionProxyHelper;
use Mpietrucha\Utility\Fork\Contracts\ContentInterface;
use Mpietrucha\Utility\Fork\Transformer;
use Mpietrucha\Utility\Str;

class HigherOrderCollectionProxyExtension extends Transformer
{
    public function class(): string
    {
        return \Larastan\Larastan\Methods\HigherOrderCollectionProxyExtension::class;
    }

    public function transform(ContentInterface $content): void
    {
        Str::sprintf('use %s;', HigherOrderCollectionProxyHelper::class) |> $content->line(8)->set(...);
    }
}
