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

    public function validate(): bool
    {
        $chances = $this->chances();

        return $chances ? Adapter::odds(1, $chances)->choose() : false;
    }

    protected function chances(): ?int
    {
        return $this->chances;
    }
}
