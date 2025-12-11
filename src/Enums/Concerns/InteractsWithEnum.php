<?php

namespace Mpietrucha\Utility\Enums\Concerns;

use BackedEnum;
use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Data;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Str;

/**
 * @phpstan-require-implements \Mpietrucha\Utility\Enums\Contracts\InteractsWithEnumInterface
 */
trait InteractsWithEnum
{
    public static function use(): string
    {
        return static::class;
    }

    public static function default(): static
    {
        return static::cases() |> Arr::first(...);
    }

    public static function collection(): EnumerableInterface
    {
        return static::cases() |> Collection::create(...);
    }

    public function key(): string
    {
        return $this->name;
    }

    public function value(): int|string
    {
        return match (true) {
            $this instanceof BackedEnum => $this->value,
            default => $this->key()
        };
    }

    public function label(): string
    {
        $value = $this->value() |> Normalizer::string(...);

        return match (true) {
            Str::upper($value) === $value => $value,
            default => Str::headline($value)
        } |> Str::lower(...) |> Str::ucfirst(...);
    }

    public function lookup(mixed $input): mixed
    {
        $value = $this->value();

        return Data::get($input, $value);
    }
}
