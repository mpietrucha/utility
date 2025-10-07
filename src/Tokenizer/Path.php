<?php

namespace Mpietrucha\Utility\Tokenizer;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Instance\Path as Adapter;
use Mpietrucha\Utility\Tokenizer;
use Mpietrucha\Utility\Tokenizer\Contracts\PathInterface;
use Mpietrucha\Utility\Tokenizer\Contracts\TokenInterface;
use Mpietrucha\Utility\Tokenizer\Contracts\TokenizerInterface;
use Mpietrucha\Utility\Type;

class Path implements CreatableInterface, PathInterface
{
    use Creatable;

    public function __construct(protected TokenizerInterface $tokenizer)
    {
    }

    public static function for(string $code): static
    {
        return Tokenizer::create($code) |> static::create(...);
    }

    public function namespace(): ?TokenInterface
    {
        return Path\Name::get() |> $this->tokens()->first->is(...);
    }

    public function name(): ?TokenInterface
    {
        return $this->tokens()->pipeThrough([
            fn (EnumerableInterface $tokens) => Path\Name::previous() |> $tokens->skipUntil->is(...),
            fn (EnumerableInterface $tokens) => Path\Name::next() |> $tokens->first->is(...),
        ]);
    }

    public function canonicalize(): ?TokenInterface
    {
        return Path\Name::canonicalized() |> $this->build(...);
    }

    public function get(bool $canonicalized = false): ?TokenInterface
    {
        if ($canonicalized) {
            return $this->canonicalize();
        }

        return Path\Name::get() |> $this->build(...);
    }

    protected function build(int $id): ?TokenInterface
    {
        [$namespace, $name] = [$this->namespace(), $this->name()];

        if (Type::null($name)) {
            return null;
        }

        if (Type::null($namespace)) {
            return null;
        }

        if ($id === Path\Name::canonicalized()) {
            $namespace = Adapter::canonicalize($namespace);
        }

        return Token::create($id, Adapter::join($namespace, $name));
    }

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, \Mpietrucha\Utility\Tokenizer\Contracts\TokenInterface>
     */
    protected function tokens(): EnumerableInterface
    {
        return $this->tokenizer()->get();
    }

    protected function tokenizer(): TokenizerInterface
    {
        return $this->tokenizer;
    }
}
