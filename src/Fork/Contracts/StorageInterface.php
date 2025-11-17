<?php

namespace Mpietrucha\Utility\Fork\Contracts;

use Mpietrucha\Utility\Utilizer\Contracts\UtilizableInterface;

interface StorageInterface extends UtilizableInterface
{
    /**
     * Validate the storage.
     */
    public function validate(): void;

    /**
     * Flush the storage.
     */
    public function flush(): void;

    /**
     * Generate a unique identifier for the given override.
     */
    public function identify(OverrideInterface $override): string;

    /**
     * Store the given override and return its identifier.
     */
    public function store(OverrideInterface $override): string;

    /**
     * Transform the override to its storage representation.
     */
    public function transform(OverrideInterface $override): string;
}
