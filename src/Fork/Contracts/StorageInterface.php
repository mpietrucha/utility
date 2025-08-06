<?php

namespace Mpietrucha\Utility\Fork\Contracts;

interface StorageInterface
{
    public function flush(): void;

    public function validate(): void;

    public function identify(TransformerInterface $transformer): string;

    public function store(TransformerInterface $transformer): string;

    public function transform(TransformerInterface $transformer): string;
}
