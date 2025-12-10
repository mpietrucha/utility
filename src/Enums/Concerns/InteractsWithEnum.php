<?php

namespace Mpietrucha\Utility\Enums\Concerns;

use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Data;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

/**
 * @phpstan-require-implements \Mpietrucha\Utility\Enums\Contracts\InteractsWithEnumInterface
 */
trait InteractsWithEnum
{
    public static function default(): static
    {
        return static::cases() |> Arr::first(...);
    }

    public static function collection(): EnumerableInterface
    {
        return static::cases() |> Collection::create(...);
    }

    public function extract(mixed $input): mixed
    {
        return Data::get($input, $this->value());
    }

    public function name(): string
    {
        return $this->name;
    }

    public function value(): mixed
    {
        return $this->value;
    }
}
