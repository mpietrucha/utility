<?php

namespace Mpietrucha\Utility\Fork\Contracts;

use Mpietrucha\Utility\Filesystem\Contracts\InteractsWithOutputInterface;

interface StorageInterface extends InteractsWithOutputInterface
{
    public function validate(): void;

    public function flush(): void;

    public function identify(TransformerInterface $transformer): string;

    public function store(TransformerInterface $transformer): string;

    public function transform(TransformerInterface $transformer): string;
}
