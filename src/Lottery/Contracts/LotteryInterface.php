<?php

namespace Mpietrucha\Utility\Lottery\Contracts;

interface LotteryInterface
{
    /**
     * Execute the lottery.
     */
    public function __invoke(): mixed;

    /**
     * Create a new lottery with the given odds.
     */
    public static function odds(int $chances, int $of): static;

    /**
     * Create a new lottery with the given percentage chance.
     */
    public static function percentage(int $percentage): static;

    /**
     * Create a new lottery that always wins.
     */
    public static function win(): static;

    /**
     * Create a new lottery that always loses.
     */
    public static function lose(): static;

    /**
     * Set the callback to execute when the lottery wins.
     */
    public function won(callable $won): static;

    /**
     * Set the callback to execute when the lottery loses.
     */
    public function lost(callable $lost): static;

    /**
     * Determine if the lottery wins.
     */
    public function wins(?callable $won = null, ?callable $lost = null): bool;

    /**
     * Determine if the lottery loses.
     */
    public function loses(?callable $lost = null, ?callable $won = null): bool;

    /**
     * Run the lottery and return the result.
     */
    public function run(): mixed;
}
