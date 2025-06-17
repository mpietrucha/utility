<?php

namespace Mpietrucha\Utility\Backtrace;

enum Property: string
{
    case FILE = 'file';

    case LINE = 'line';

    case TYPE = 'type';

    case ARGUMENTS = 'args';

    case NAMESPACE = 'class';

    case INSTANCE = 'object';

    case FUNCTION = 'function';

    public function name(): string
    {
        return $this->value;
    }
}
