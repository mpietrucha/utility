<?php

namespace Mpietrucha\Support;

use Closure;
use Mpietrucha\Support\Concerns\Errorable;
use Mpietrucha\Support\Concerns\Factoryable;
use Mpietrucha\Support\Exception\InvalidArgumentException;
use Mpietrucha\Support\Exception\RuntimeException;

use function Mpietrucha\Support\Disclosure\disclosure;
use function Mpietrucha\Support\Disclosure\value;

class Instance
{
    use Errorable;
    use Factoryable;

    protected ?object $instance = null;

    protected array|Closure $arguments = [];

    protected bool|Closure $flushable = false;

    public function __construct(protected null|string|object $source = null, mixed ...$arguments)
    {
        $this->arguments($arguments);
    }

    public function __invoke(mixed ...$arguments): mixed
    {
        return $this->arguments($arguments)->get();
    }

    public function flushable(mixed $flushable = true): self
    {
        disclosure($this)->boolean()->flushable = $flushable;

        return $this;
    }

    public function source(string|object $source, mixed ...$arguments): self
    {
        $this->source = $source;

        return $this->arguments($arguments);
    }

    public function arguments(mixed $arguments): self
    {
        if ($arguments) {
            disclosure($this)->array()->arguments = $arguments;
        }

        return $this;
    }

    public function get(): mixed
    {
        if (! $source = $this->source) {
            return $this->fail(fn () => InvalidArgumentException::create('Cannot create instance from empty source.'));
        }

        if ($flushable = value($this->flushable, $source)) {
            $this->instance = null;
        }

        if ($this->instance) {
            return $this->instance;
        }

        if (Type::create($source)->string()) {
            $source = fn (mixed ...$arguments) => new $source(...$arguments);
        }

        if (! $source instanceof Closure) {
            RuntimeException::create()->when($flushable)->throw('Only string or closure source can be flushed.');

            return $this->instance = $source;
        }

        return $this->instance = Rescue::create($source)->withoutInstanceArguments()->errorable($this)(
            ...value($this->arguments, $source)
        );
    }
}
