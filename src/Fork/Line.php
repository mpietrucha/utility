<?php

namespace Mpietrucha\Utility\Fork;

use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Fork\Contracts\BodyInterface;
use Mpietrucha\Utility\Str;
use Mpietrucha\Utility\Type;

class Line extends Section
{
    /**
     * @var \Mpietrucha\Utility\Collection<int, string>
     */
    protected ?Collection $lines = null;

    public function __construct(BodyInterface $body, protected int $line)
    {
        parent::__construct($body);
    }

    public function clear(): void
    {
        $this->toString() |> $this->set(...);
    }

    public function set(string $content): void
    {
        $this->lines()->put($this->line(), $content);

        Str::eol() |> $this->lines()->join(...) |> $this->body()->set(...);
    }

    public function replace(string $search, string $content): void
    {
        $line = $this->line() |> $this->lines()->get(...);

        if (Type::null($line)) {
            return;
        }

        /** @var string $line */
        Str::replace($search, $content, $line) |> $this->set(...);
    }

    /**
     * @return \Mpietrucha\Utility\Collection<int, string>
     */
    protected function lines(): Collection
    {
        return $this->lines ??= $this->body()->toStringable()->lines();
    }

    protected function line(): int
    {
        return $this->line - 1;
    }
}
