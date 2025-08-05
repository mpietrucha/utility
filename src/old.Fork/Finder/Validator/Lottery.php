<?php

namespace Mpietrucha\Utility\Finder\Validator;

use Illuminate\Support\Lottery as Adapter;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Finder\Contracts\ValidatorInterface;

class Lottery implements CreatableInterface, ValidatorInterface
{
    use Creatable;

    public function __construct(protected ?int $chances = 1000)
    {
    }

    public static function wins(): static
    {
        return static::create(null);
    }

    public function due(): bool
    {
        return Adapter::odds(1, $this->chances() ?? 1)->choose();
    }

    protected function chances(): ?int
    {
        return $this->chances;
    }
}
