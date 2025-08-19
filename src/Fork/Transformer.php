<?php

namespace Mpietrucha\Utility\Fork;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Fork\Contracts\BodyInterface;
use Mpietrucha\Utility\Fork\Contracts\TransformerInterface;
use Mpietrucha\Utility\Instance;
use Mpietrucha\Utility\Normalizer;

abstract class Transformer implements CreatableInterface, TransformerInterface
{
    use Creatable;

    protected ?string $file = null;

    public function file(): string
    {
        return $this->file ??= $this->find();
    }

    public function prefix(): string
    {
        return 'Fork';
    }

    public function namespace(): string
    {
        return Instance\FQN::join($this->prefix(), $this->class());
    }

    public function body(string $content): BodyInterface
    {
        $names = [
            $this->class() |> Transformer\Normalizer::name(...),
            $this->namespace() |> Transformer\Normalizer::name(...),
        ];

        $namespaces = [
            $this->class() |> Transformer\Normalizer::namespace(...),
            $this->namespace() |> Transformer\Normalizer::namespace(...),
        ];

        return Body::create($content)->replace(...$names)->replace(...$namespaces);
    }

    protected function find(): string
    {
        return $this->class() |> Instance::file(...) |> Normalizer::string(...);
    }
}
