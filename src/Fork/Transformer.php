<?php

namespace Mpietrucha\Utility\Fork;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Fork\Contracts\SourceInterface;
use Mpietrucha\Utility\Fork\Contracts\TransformerInterface;
use Mpietrucha\Utility\Instance;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Str;
use Mpietrucha\Utility\Symbol;

abstract class Transformer implements CreatableInterface, TransformerInterface
{
    use Creatable;

    protected ?string $location = null;

    public static function source(string $content): SourceInterface
    {
        return Source::create($content);
    }

    public function file(): string
    {
        return $this->location ??= $this->locate();
    }

    public function prefix(): string
    {
        return 'Fork';
    }

    public function namespace(): string
    {
        $delimiter = Symbol::namespace();

        $prefix = $this->prefix() |> Str::of(...);

        return $this->class() |> $prefix->trim($delimiter)->wrap($delimiter)->append(...);
    }

    protected function locate(): string
    {
        return $this->class() |> Instance::file(...) |> Normalizer::string(...);
    }
}
