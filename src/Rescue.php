<?php

namespace Mpietrucha\Support;

use Closure;
use Illuminate\Support\Collection;
use Mpietrucha\Support\Concerns\Errorable;
use Mpietrucha\Support\Concerns\Factoryable;
use Mpietrucha\Support\Concerns\Singletonable;
use Mpietrucha\Support\Concerns\Sleepable;
use Mpietrucha\Support\Exception\BadMethodCallException;
use Mpietrucha\Support\Exception\InvalidArgumentException;
use Throwable;

use function Mpietrucha\Support\Disclosure\disclosure;
use function Mpietrucha\Support\Disclosure\value;
use function Mpietrucha\Support\Disclosure\not;

class Rescue
{
    use Errorable;
    use Factoryable;
    use Singletonable;
    use Sleepable;

    protected int $attempt = 1;

    protected ?Closure $before = null;

    protected ?Throwable $exception = null;

    protected bool|Closure $instanceArguments = true;

    public function __construct(protected mixed $callback, protected int $attempts = 1)
    {
        $this->quiet();
    }

    public function __invoke(mixed ...$arguments): mixed
    {
        return $this->get(...$arguments);
    }

    public static function attempt(): int
    {
        return self::instance()->attempt;
    }

    public static function exception(): ?Throwable
    {
        return self::instance()->exception;
    }

    protected static function singletonable(Singleton $singleton): void
    {
        BadMethodCallException::create()->throw('Accessing instance properties is allowed only in callback.');
    }

    public function attempts(int $attempts): self
    {
        $this->attempts = $attempts;

        return $this;
    }

    public function before(Closure $before): self
    {
        $this->before = $before;

        return $this;
    }

    public function withInstanceArguments(mixed $instanceArguments = true): self
    {
        disclosure($this)->boolean()->instanceArguments = $instanceArguments;

        return $this;
    }

    public function withoutInstanceArguments(mixed $instanceArguments = false): self
    {
        disclosure($this)->boolean()->instanceArguments = not($instanceArguments);

        return $this;
    }

    public function get(mixed ...$arguments): mixed
    {
        value($this->before, ...$arguments = collect($arguments)->when($this->instanceArguments, function (Collection $arguments) {
            $arguments->push($this->attempt, $this->exception);
        }));

        if ($this->attempt > $this->attempts) {
            InvalidArgumentException::create()->unless($this->exception)->throw('Attempts must be positive integer.');

            return $this->fail($this->exception);
        }

        try {
            self::singleton()->source($this);

            return value($this->callback, ...$arguments);
        } catch (Throwable $exception) {
            $this->attempt++;

            $this->exception = $exception;
        } finally {
            self::singleton()->destroy();
        }

        $this->wait($this->attempt, $this->exception);

        return $this->get(...$arguments);
    }
}
