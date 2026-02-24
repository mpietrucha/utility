<?php

namespace Mpietrucha\Utility\Throwable\Enums;

use Mpietrucha\Utility\Enums\Concerns\InteractsWithEnum;
use Mpietrucha\Utility\Enums\Contracts\InteractsWithEnumInterface;

enum Property: string implements InteractsWithEnumInterface
{
    use InteractsWithEnum;

    case Line = 'line';

    case File = 'file';

    case Code = 'code';

    case Trace = 'trace';

    case Message = 'message';

    case Previous = 'previous';
}
