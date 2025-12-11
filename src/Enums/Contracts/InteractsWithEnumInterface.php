<?php

namespace Mpietrucha\Utility\Enums\Contracts;

use BackedEnum;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

/**
 * @phpstan-type EnumsCollection \Mpietrucha\Utility\Collection<int, static>
 */
interface InteractsWithEnumInterface extends BackedEnum
{
    public static function default(): static;

    /**
     * @return EnumsCollection
     */
    public static function collection(): EnumerableInterface;

    public function extract(mixed $input): mixed;

    public function key(): string;

    public function value(): mixed;
}
