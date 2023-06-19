<?php

namespace App\Action\Player;

use App\Enum\StatusGame;
use App\Models\Game;
use App\Models\GameMove;
use App\Models\Player;
use Exception;

class ActionMakeMove
{
    public static function makeMove(Game $game, Player $player, $row, $col)
    {
        $gameStruct = $game->getGameStruct();

        // Verifica se é a vez do jogador atual
        if ($player !== $game->getCurrentPlayer()) {
            throw new \Exception('Não é a vez desse jogador.');
        }

        // Cria um objeto GameMove com a jogada
        $move = new GameMove();
        $move->newMove($player, $row, $col);

        // Verifica se a jogada é válida
        if (!$move->isValidMove($gameStruct)) {
            throw new Exception('Jogada inválida.');
        }

        // Realiza a jogada
        $symbol = $game->getPlayerPosition($player);
        $move->makeMove($gameStruct, $symbol);

        // Salva a jogada no banco de dados
        $move->save();

        // Verifica se houve um vencedor
        if ($game->checkWin($symbol)) {
            $game->status = StatusGame::Finished;
            $game->save();
            return $player;
        }

        // Verifica se houve empate
        if ($game->checkDraw()) {
            $game->status = StatusGame::Finished;
            $game->save();
            return 'draw';
        }

        // Alterna entre os jogadores
        $game->switchPlayer();
        $game->save();

        return null;
    }
}
