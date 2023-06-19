<?php

namespace App\Action\Player;

use App\Enum\StatusGame;
use App\Models\Game;
use App\Models\GameStruct;
use App\Models\Player;

class ActionSaveGame
{
    public static function saveGame(Game $gameInMemory)
    {
        $game = Game::find($gameInMemory->id);
        if ($game === null) {
            $game = new Game();
        }
        $game->status = $gameInMemory->status === null ? StatusGame::NotStarted : $gameInMemory->getStatus();
        $game->player1_id           = $gameInMemory->getPlayer1()->id;
        $game->player2_id           = $gameInMemory->getPlayer2()->id;
        $game->game_struct_id       = self::saveGameStruct($gameInMemory->getGameStruct(), $game->player1_id)->id;
        $game->started_game_time    = date('Y-m-d H:i:s');
        $game->save();
        return $game;
    }

    private static function saveGameStruct(GameStruct $gameStructInMemory, int $playerId) : GameStruct
    {
        $gameStruct = GameStruct::find($gameStructInMemory->id);
        if ($gameStruct === null) {
            $gameStruct = new GameStruct();
        }
        $gameStruct->positions      = json_encode($gameStructInMemory->getBoard());
        $gameStruct->who_started    = $playerId;
        $gameStruct->current_move   = $playerId;
        $gameStruct->save();
        return $gameStruct;
    }

}
