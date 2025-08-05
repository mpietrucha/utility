<?php

namespace Mpietrucha\Utility\Fork;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Fork\Contracts\ContentInterface;
use Mpietrucha\Utility\Fork\Contracts\LineInterface;

class Line implements CreatableInterface, LineInterface
{
    use Creatable;

    public function __construct(protected ContentInterface $content, protected ?string $line)
    {
    }

    public function get(): ?string
    {
        return $this->line;
    }

    public function clear(): void
    {
        $this->adapter()->clear();
    }

    public function change(string $to): void
    {
        $this->adapter($to)->change();
    }

    protected function content(): ContentInterface
    {
        return $this->content;
    }
}
