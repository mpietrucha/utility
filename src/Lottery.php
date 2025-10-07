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

    public function __construct(protected mixed $evaluable)
    {
    }

    public function __invoke(): mixed
    {
        return $this->run();
    }

    public static function odds(float|int $chances, int $of): static
    {
        return Adapter::create($chances, $of) |> static::create(...);
    }

    public static function percentage(int $percentage): static
    {
        return $percentage / 100 |> Adapter::create(...) |> static::create(...);
    }

    public static function win(): static
    {
        return static::percentage(100);
    }

    public static function lose(): static
    {
        return static::percentage(0);
    }

    public function won(callable $won): static
    {
        $this->callbacks()->put(1, $won);

        return $this;
    }

    public function lost(callable $lost): static
    {
        $this->callbacks()->put(0, $lost);

        return $this;
    }

    public function wins(?callable $won = null, ?callable $lost = null): bool
    {
        $wins = $this->evaluable() |> $this->eval(...) |> Normalizer::boolean(...);

        Collection::from($lost, $won)->get($wins) |> $this->eval(...);

        $this->call($wins);

        return $wins;
    }

    final public function loses(?callable $lost = null, ?callable $won = null): bool
    {
        return $this->wins($won, $lost) |> Normalizer::not(...);
    }

    public function run(): mixed
    {
        return $this->wins() |> $this->call(...);
    }

    protected function call(bool $wins): mixed
    {
        return Normalizer::integer($wins) |> $this->callbacks()->get(...) |> $this->eval(...);
    }

    protected function eval(mixed $evaluable): mixed
    {
        return Value::for($evaluable)->get();
    }

    protected function evaluable(): mixed
    {
        return $this->evaluable;
    }

    /**
     * @return \Mpietrucha\Utility\Collection<int, callable>
     */
    protected function callbacks(): EnumerableInterface
    {
        return $this->callbacks ??= Collection::create();
    }
}
