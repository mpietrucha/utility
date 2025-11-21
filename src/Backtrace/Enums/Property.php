<?php

namespace Mpietrucha\Utility\Backtrace\Enums;

enum Property: string
{
    case FILE = 'file';

    case LINE = 'line';

    case TYPE = 'type';

    case ARGUMENTS = 'args';

    case NAMESPACE = 'class';

    case INSTANCE = 'object';

    case FUNCTION = 'function';
}
