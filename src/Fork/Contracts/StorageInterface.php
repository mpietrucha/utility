<?php

namespace Mpietrucha\Utility\Fork\Contracts;

use Mpietrucha\Utility\Utilizer\Contracts\UtilizableInterface;

interface StorageInterface extends UtilizableInterface
{
    public function validate(): void;

    public function flush(): void;

    public function identify(OverrideInterface $override): string;

    public function store(OverrideInterface $override): string;

    public function transform(OverrideInterface $override): string;
}
