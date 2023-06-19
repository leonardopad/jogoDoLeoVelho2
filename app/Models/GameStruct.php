<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameStruct extends Model
{
    use HasFactory;

    //   00       01       02
    // ------|----------|-------
    //   10       11       12
    // ------|----------|-------
    //   20       21       22
    // ------|----------|-------

    private $board = [
                '00' => '',
                '01' => '',
                '02' => '',
                '10' => '',
                '11' => '',
                '12' => '',
                '20' => '',
                '21' => '',
                '22' => '',
                ];

    public function game()
    {
        return $this->hasOne(Game::class);
    }

    public function getBoard()
    {
        return $this->board;
    }

    public function isPositionEmpty($row, $col) : bool
    {
        $key = $row . $col;
        return $this->board[$key] === '';
    }

    public function makeMove($row, $col, $player)
    {
        $key = $row . $col;
        $this->board[$key] = $player;
    }
}


