<?php

namespace Mpietrucha\Utility\Fork\Contracts;

interface TransformerInterface
{
    public function content(string $content): ContentInterface;

    public function storage(): StorageInterface;

    public function class(): string;

    public function namespace(): string;

    public function transform(ContentInterface $content): void;
}
