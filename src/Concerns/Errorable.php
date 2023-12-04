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
    protected mixed $whenFails = null;

    protected bool|Closure $throwingExceptions = true;

    public function throw(mixed $throw = true): self
    {
        disclosure($this)->boolean()->throwingExceptions = $throw;

        return $this;
    }

    public function quiet(mixed $quiet = true): self
    {
        disclosure($this)->boolean()->throwingExceptions = not($quiet);

        return $this;
    }

    public function errorable(object $source): self
    {
        InvalidArgumentException::create()->unless(function () use ($source) {
            return class_uses_trait($source, __TRAIT__);
        })->throw('Errorable source must use [%s] trait.', __TRAIT__);

        dd('xd');
    }

    public function whenFailsReturn(mixed $response): self
    {
        $this->whenFails = $response;

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
        if (value($this->throwingExceptions, $exception = lazy($exception), ...$arguments)) {
            throw $exception();
        }

        return value($this->whenFails, $exception, ...$arguments);
    }
}
