<?php

namespace Mpietrucha\Support\Concerns;

use Closure;
use Mpietrucha\Support\Exception\InvalidArgumentException;
use Throwable;

use function Mpietrucha\Support\class_uses_trait;
use function Mpietrucha\Support\Disclosure\disclosure;
use function Mpietrucha\Support\Disclosure\lazy;
use function Mpietrucha\Support\Disclosure\not;
use function Mpietrucha\Support\Disclosure\value;

trait Errorable
{
    protected bool $failed = false;

    protected mixed $failing = null;

    protected bool|Closure $throwing = true;

    public function throw(mixed $throw = true): self
    {
        disclosure($this)->boolean()->throwing = $throw;

        return $this;
    }

    public function quiet(mixed $quiet = true): self
    {
        disclosure($this)->boolean()->throwing = not($quiet);

        return $this;
    }

    public function errorable(object $source): self
    {
        InvalidArgumentException::create()->unless(function () use ($source) {
            return class_uses_trait($source, __TRAIT__);
        })->throw('Errorable source must use [%s] trait.', __TRAIT__);

        $source = invade($source);

        return $this->throw($source->throwing)->whenFailsReturn($source->failing);
    }

    public function whenFailsReturn(mixed $response): self
    {
        $this->failing = $response;

        return $this;
    }

    public function whenFailsReturnThis(): self
    {
        return $this->whenFailsReturn(fn () => $this);
    }

    public function whenFailsReturnNull(): self
    {
        return $this->whenFailsReturn(null);
    }

    public function whenFailsReturnFalse(): self
    {
        return $this->whenFailsReturn(false);
    }

    public function whenFailsReturnEmptyArray(): self
    {
        return $this->whenFailsReturn([]);
    }

    public function whenFailsReturnEmptyCollection(): self
    {
        return $this->whenFails(fn () => collect());
    }

    protected function fail(Throwable|Closure $exception, mixed ...$arguments): mixed
    {
        if (value($this->throwing, $exception = lazy($exception), ...$arguments)) {
            throw $exception();
        }

        $this->failed = true;

        return value($this->failing, $exception, ...$arguments);
    }

    protected function wasPreviouslyFailed(): bool
    {
        return $this->failed;
    }
}
