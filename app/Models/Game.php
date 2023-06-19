<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model
{
    use HasFactory;

    private Player $player1;
    private Player $player2;
    private GameStruct $gameStruct;
    private $moves;
    private $currentPlayer;

    public function player1(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'player1_id');
    }

    public function player2(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'player2_id');
    }

    public function getGameStruct() : GameStruct
    {
        return $this->gameStruct;
    }

    public function getPlayer1() : Player
    {
        return $this->player1;
    }

    public function getPlayer2() : Player
    {
        return $this->player2;
    }

    public function makeGame(Player $player1, Player $player2) : Game
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
        $this->gameStruct = new GameStruct();
        $this->moves = [];

        return $this;
    }

    /**
     * @throws Exception
     */
    public function makeMove(Player $player, $row, $col)
    {
        // Verifica se é a vez do jogador atual
        if ($player !== $this->getCurrentPlayer()) {
            throw new Exception('Não é a vez desse jogador.');
        }

        // Cria um objeto GameMove com a jogada
        $move = new GameMove($player, $row, $col);

        // Verifica se a jogada é válida
        if (!$move->isValidMove($this->gameStruct)) {
            throw new Exception('Jogada inválida.');
        }

        // Realiza a jogada
        $symbol = $this->getPlayerPosition($player);
        $move->makeMove($this->gameStruct, $symbol);

        // Adiciona a jogada à lista de movimentos
        $this->moves[] = $move;

        // Verifica se houve um vencedor
        if ($this->checkWin($symbol)) {
            return $player;
        }

        // Verifica se houve empate
        if ($this->checkDraw()) {
            return 'draw';
        }

        if ($this->currentPlayer === $this->player1) {
            $this->currentPlayer = $this->player2;
        } else {
            $this->currentPlayer = $this->player1;
        }

        return null;
    }

    public function getCurrentPlayer()
    {
        return $this->currentPlayer ?? $this->player1;
    }

    private function getPlayerPosition(Player $player): string
    {
        // Define o símbolo do jogador no tabuleiro
        return $player === $this->player1 ? 'player1' : 'player2';
    }

    private function switchPlayer()
    {
        // Alterna entre os jogadores
        $temp = $this->player1;
        $this->player1 = $this->player2;
        $this->player2 = $temp;
    }

    private function checkWin(string $player): bool
    {
        $board = $this->gameStruct->getBoard();

        // Verifica todas as possibilidades de vitória
        for ($i = 0; $i < 3; $i++) {
            // Verifica linhas
            if ($board[$i . '0'] === $player && $board[$i . '1'] === $player && $board[$i . '2'] === $player) {
                return true;
            }
            // Verifica colunas
            if ($board['0' . $i] === $player && $board['1' . $i] === $player && $board['2' . $i] === $player) {
                return true;
            }
        }
        // Verifica diagonais
        if ($board['00'] === $player && $board['11'] === $player && $board['22'] === $player) {
            return true;
        }
        if ($board['02'] === $player && $board['11'] === $player && $board['20'] === $player) {
            return true;
        }

        return false;
    }

    private function checkDraw(): bool
    {
        $board = $this->gameStruct->getBoard();
        foreach ($board as $position) {
            if ($position === '') {
                return false;
            }
        }
        return true;
    }
}
