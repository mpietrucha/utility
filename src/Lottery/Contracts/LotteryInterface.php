<?php

namespace Mpietrucha\Utility\Lottery\Contracts;

interface LotteryInterface
{
    public function __invoke(): mixed;

    public static function odds(int $chances, int $of): LotteryInterface;

    public static function percentage(int $percentage): LotteryInterface;

    public static function win(): LotteryInterface;

    public static function lose(): LotteryInterface;

    public function won(callable $won): LotteryInterface;

    public function lost(callable $lost): LotteryInterface;

    public function wins(?callable $won = null, ?callable $lost = null): bool;

    public function loses(?callable $lost = null, ?callable $won = null): bool;

    public function run(): mixed;
}
