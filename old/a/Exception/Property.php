<?php

namespace Mpietrucha\Utility\Exception;

enum Property: string
{
    case LINE = 'line';

    case FILE = 'file';

    case CODE = 'code';

    case MESSAGE = 'message';

    case BACKTRACE = 'trace';

    case PREVIOUS = 'previous';

    public function name(): string
    {
        return $this->value;
    }
}
