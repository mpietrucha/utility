<?php

namespace Mpietrucha\Support;

use Mpietrucha\Support\Concerns\Errorable;
use Mpietrucha\Support\Concerns\Factoryable;
use Mpietrucha\Support\Concerns\Sleepable;
use Mpietrucha\Support\Exception\InvalidArgumentException;
use Throwable;

use function Mpietrucha\Support\Disclosure\value;

class Rescue
{
    use Errorable;
    use Factoryable;
    use Sleepable;

    protected int $attempt = 1;

    protected ?Throwable $exception = null;

    public function __construct(protected mixed $callback, protected int $attempts = 1)
    {
        $this->quiet();
    }

    public function __invoke(mixed ...$arguments): mixed
    {
        return $this->get(...$arguments);
    }

    public function attempts(int $attempts): self
    {
        $this->attempts = $attempts;

        return $this;
    }

    public function get(mixed ...$arguments): mixed
    {
        if ($this->attempt > $this->attempts) {
            InvalidArgumentException::create()->unless($this->exception)->throw('Attempts must be positive integer.');

            return $this->fail($this->exception);
        }

        try {
            return value($this->callback, ...collect($arguments)->push($this->attempt, $this->exception));
        } catch (Throwable $exception) {
            $this->attempt++;

            $this->exception = $exception;
        }

        $this->wait($this->attempt, $this->exception);

        return $this->get(...$arguments);
    }
}
