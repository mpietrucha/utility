<?php

namespace Mpietrucha\Utility\Enums\Contracts;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use UnitEnum;

/**
 * @phpstan-type EnumCasesCollection \Mpietrucha\Utility\Collection<int, static>
 */
interface InteractsWithEnumInterface extends UnitEnum
{
    /**
     * @return class-string<static>
     */
    public static function use(): string;

    public static function default(): static;

    /**
     * @return EnumCasesCollection
     */
    public static function collection(): EnumerableInterface;

    public function key(): string;

    public function value(): int|string;

    public function label(): string;

    public function lookup(mixed $input): mixed;
}
