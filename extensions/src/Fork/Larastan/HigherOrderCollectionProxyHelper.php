<?php

namespace Mpietrucha\Extensions\Fork\Larastan;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Fork\Contracts\BodyInterface;
use Mpietrucha\Utility\Fork\Transformer;
use Mpietrucha\Utility\Str;

class HigherOrderCollectionProxyHelper extends Transformer
{
    public function class(): string
    {
        return \Larastan\Larastan\Support\HigherOrderCollectionProxyHelper::class;
    }

    public function transform(BodyInterface $body): void
    {
        Str::sprintf('use %s as SupportCollection;', EnumerableInterface::class) |> $body->line(7)->set(...);
    }
}
