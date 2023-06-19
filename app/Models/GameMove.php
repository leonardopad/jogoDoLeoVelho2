<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameMove extends Model
{
    use HasFactory;

    private $player;
    private $row;
    private $col;

    public function newMove(Player $player, $row, $col)
    {
        $this->player = $player;
        $this->row = $row;
        $this->col = $col;
    }

    public function getPlayer()
    {
        return $this->player;
    }

    public function getRow()
    {
        return $this->row;
    }

    public function getCol()
    {
        return $this->col;
    }

    public function isValidMove(GameStruct $gameStruct)
    {
        return $gameStruct->isPositionEmpty($this->row, $this->col);
    }

    public function makeMove(GameStruct $gameStruct, $player)
    {
        $gameStruct->makeMove($this->row, $this->col, $player);
    }
}
