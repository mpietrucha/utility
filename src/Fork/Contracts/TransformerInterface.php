<?php

namespace Mpietrucha\Utility\Fork\Contracts;

interface TransformerInterface
{
    public static function source(string $content): SourceInterface;

    public function file(): string;

    public function class(): string;

    public function namespace(): string;

    public function transform(SourceInterface $source): void;
}
