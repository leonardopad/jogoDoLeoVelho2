<?php

namespace App\Http\Controllers;

use App\Action\Player\ActionMakeMove;
use App\Action\Player\ActionSaveGame;
use App\Models\Game;
use App\Models\Player;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GameController extends Controller
{
    public function createGame(Request $request, Response $response)
    {
        $player1 = Player::find($request->player1_id);
        $player2 = Player::find($request->player2_id);

        $game = (new Game())->makeGame($player1, $player2);

        $game = ActionSaveGame::saveGame($game);

        return $response->setContent($game)
                        ->setStatusCode(201);
    }


    public function createMove(Request $request)
    {
        $gameId = $request->game_id;
        $playerId = $request->player_id;
        $row = $request->row;
        $col = $request->col;

        $game = Game::find($gameId);
        if (!$game) {
            return response()->json(['error' => 'Jogo não encontrado'], 404);
        }

        try {
            $player = Player::find($playerId);
            if (!$player) {
                return response()->json(['error' => 'Jogador não encontrado'], 404);
            }

            $result = ActionMakeMove::makeMove($game, $player, $row, $col);

            if ($result instanceof Player) {
                return response()->json(['winner' => $result->id], 200);
            } elseif ($result === 'draw') {
                return response()->json(['result' => 'Empate'], 200);
            } else {
                return response()->json(['result' => 'Jogada realizada'], 200);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function getGame(int $gameId)
    {
        $game = Game::find($gameId);

        if (!$game) {
            return response()->json(['error' => 'Jogo não encontrado'], 404);
        }

        return response()->json($game, 200);
    }
}
