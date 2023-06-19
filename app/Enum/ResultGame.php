<?php

namespace App\Enum;

use App\Traits\OptionsEnum;

enum ResultGame : string
{
    use OptionsEnum;

    case Player1   = 'player1';
    case Player2   = 'player2';
    case ATie      = 'a-tie';
}


