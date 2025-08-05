<?php

namespace Mpietrucha\Utility\Fork\Contracts;

interface StorageInterface
{
    public function file(): string;

    public function validate(): void;

    public function set(): void;

    public function flush(): void;
}
