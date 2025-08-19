<?php

namespace Mpietrucha\Utility\Fork\Contracts;

interface TransformerInterface
{
    public function file(): string;

    public function class(): string;

    public function namespace(): string;

    public function body(string $content): BodyInterface;

    public function transform(BodyInterface $body): void;
}
