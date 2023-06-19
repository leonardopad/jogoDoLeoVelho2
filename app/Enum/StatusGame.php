<?php

namespace App\Enum;

use App\Traits\OptionsEnum;

enum StatusGame : string
{
    use OptionsEnum;

    case NotStarted    = 'Not Started';
    case Started       = 'Started';
    case Finished      = 'Finished';
    case Canceled      = 'Canceled';
}


