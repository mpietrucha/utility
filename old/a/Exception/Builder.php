<?php

namespace Mpietrucha\Utility\Exception;

use Mpietrucha\Utility\Backtrace;
use Mpietrucha\Utility\Backtrace\Frame;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Concerns\Pipeable;
use Mpietrucha\Utility\Concerns\Tappable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Contracts\PipeableInterface;
use Mpietrucha\Utility\Contracts\TappableInterface;
use Mpietrucha\Utility\Exception\Contracts\BuilderInterface;
use Mpietrucha\Utility\Illuminate\Str;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Reflector;
use ReflectionClass;
use Throwable;

abstract class Builder implements BuilderInterface, CreatableInterface, PipeableInterface, TappableInterface
{
    use Creatable, Pipeable, Tappable;

    protected ?ReflectionClass $reflection = null;

    protected function __construct(protected Throwable $throwable)
    {
        $this->flush();
    }

    public function frame(Frame $frame): self
    {
        $file = $frame->file();

        $line = $frame->line();

        return $this->file($file)->line($line);
    }

    public function code(int $code): self
    {
        return $this->set(Property::CODE, $code);
    }

    public function line(int $line): self
    {
        return $this->set(Property::LINE, $line);
    }

    public function file(string $file): self
    {
        return $this->set(Property::FILE, $file);
    }

    public function message(mixed $message, mixed ...$arguments): self
    {
        $message = Str::sprintf($message, $arguments);

        return $this->set(Property::MESSAGE, $message);
    }

    public function backtrace(mixed $backtrace): self
    {
        $backtrace = Normalizer::array($backtrace);

        return $this->set(Property::BACKTRACE, $backtrace);
    }

    public function previous(?Throwable $previous): self
    {
        return $this->set(Property::PREVIOUS, $previous);
    }

    public function get(): Throwable
    {
        return $this->throwable;
    }

    protected function set(Property $property, mixed $value): self
    {
        $name = $property->value;

        $this->reflection()->getProperty($name)->setValue($this->get(), $value);

        return $this;
    }

    protected function reflection(): ReflectionClass
    {
        return $this->reflection ??= Reflector::deep($this->get());
    }

    final protected function flush(): void
    {
        $backtrace = Backtrace::throwable($this)->skip(1);

        $backtrace->first()->pipe($this->frame(...));

        $backtrace->skip(1)->pipe($this->backtrace(...));
    }
}
