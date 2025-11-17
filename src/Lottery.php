<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Concerns\Pipeable;
use Mpietrucha\Utility\Concerns\Tappable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Contracts\PipeableInterface;
use Mpietrucha\Utility\Contracts\TappableInterface;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Lottery\Adapter;
use Mpietrucha\Utility\Lottery\Contracts\LotteryInterface;

class Lottery implements CreatableInterface, LotteryInterface, PipeableInterface, TappableInterface
{
    use Creatable, Pipeable, Tappable;

    /**
     * @var \Mpietrucha\Utility\Collection<int, callable>|null
     */
    protected ?Collection $callbacks = null;

    /**
     * Create a new lottery instance with the given evaluable condition.
     */
    public function __construct(protected mixed $evaluable)
    {
    }

    /**
     * Execute the lottery when invoked as a function.
     */
    public function __invoke(): mixed
    {
        return $this->run();
    }

    /**
     * Create a lottery with the specified odds.
     */
    public static function odds(float|int $chances, int $of): static
    {
        return Adapter::create($chances, $of) |> static::create(...);
    }

    /**
     * Create a lottery with the specified percentage chance.
     */
    public static function percentage(int $percentage): static
    {
        return $percentage / 100 |> Adapter::create(...) |> static::create(...);
    }

    /**
     * Create a lottery that always wins.
     */
    public static function win(): static
    {
        return static::percentage(100);
    }

    /**
     * Create a lottery that always loses.
     */
    public static function lose(): static
    {
        return static::percentage(0);
    }

    /**
     * Register a callback to execute when the lottery is won.
     */
    public function won(callable $won): static
    {
        $this->callbacks()->put(1, $won);

        return $this;
    }

    /**
     * Register a callback to execute when the lottery is lost.
     */
    public function lost(callable $lost): static
    {
        $this->callbacks()->put(0, $lost);

        return $this;
    }

    /**
     * Determine if the lottery wins and execute the appropriate callback.
     */
    public function wins(?callable $won = null, ?callable $lost = null): bool
    {
        $wins = $this->evaluable() |> $this->eval(...) |> Normalizer::boolean(...);

        Collection::from($lost, $won)->get($wins) |> $this->eval(...);

        $this->call($wins);

        return $wins;
    }

    /**
     * Determine if the lottery loses and execute the appropriate callback.
     */
    final public function loses(?callable $lost = null, ?callable $won = null): bool
    {
        return $this->wins($won, $lost) |> Normalizer::not(...);
    }

    /**
     * Execute the lottery and return the result.
     */
    public function run(): mixed
    {
        return $this->wins() |> $this->call(...);
    }

    /**
     * Call the appropriate callback based on the lottery result.
     */
    protected function call(bool $wins): mixed
    {
        return Normalizer::integer($wins) |> $this->callbacks()->get(...) |> $this->eval(...);
    }

    /**
     * Evaluate the given evaluable and return its result.
     */
    protected function eval(mixed $evaluable): mixed
    {
        return Value::for($evaluable)->get();
    }

    /**
     * Get the lottery evaluable condition.
     */
    protected function evaluable(): mixed
    {
        return $this->evaluable;
    }

    /**
     * Get the collection of lottery callbacks.
     *
     * @return \Mpietrucha\Utility\Collection<int, callable>
     */
    protected function callbacks(): EnumerableInterface
    {
        return $this->callbacks ??= Collection::create();
    }
}
