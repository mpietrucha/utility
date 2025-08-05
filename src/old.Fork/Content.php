<?php

namespace Mpietrucha\Utility\Fork;

use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Fork\Contracts\ContentInterface;

class Content implements ContentInterface, CreatableInterface
{
    use Creatable;

    protected ?Collection $lines = null;

    public function __construct(protected string $content)
    {
    }

    public function get(): string
    {

    }

    public function line(int $line): LineInterface
    {

    }

    public function set(string $content): void
    {

    }

    public function clear(string $line): void
    {

    }

    public function change(string $from, string $to): void
    {

    }
}
