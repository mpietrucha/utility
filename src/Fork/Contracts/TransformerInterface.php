<?php

namespace Mpietrucha\Utility\Fork\Contracts;

interface TransformerInterface
{
    public function file(): string;

    public function class(): string;

    public function namespace(): string;

    public function content(string $content): ContentInterface;

    public function transform(ContentInterface $content): void;
}
