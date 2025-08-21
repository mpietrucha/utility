<?php

namespace Mpietrucha\Utility\Lottery\Contracts;

interface LotteryInterface
{
    public function __invoke(): mixed;

    public static function odds(int $chances, int $of): static;

    public static function percentage(int $percentage): static;

    public static function win(): static;

    public static function lose(): static;

    public function won(callable $won): static;

    public function lost(callable $lost): static;

    public function wins(?callable $won = null, ?callable $lost = null): bool;

    public function loses(?callable $lost = null, ?callable $won = null): bool;

    public function run(): mixed;
}
