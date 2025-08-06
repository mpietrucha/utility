<?php

namespace Mpietrucha\Utility\Fork;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Fork\Contracts\SourceInterface;

class Source implements CreatableInterface, SourceInterface
{
    use Creatable;

    public function __construct(protected string $content)
    {
    }

    public function get(): string
    {
        return $this->content;
    }
}
