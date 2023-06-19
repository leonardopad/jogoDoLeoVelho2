<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\GameMove;
use Illuminate\Database\Seeder;

class GameSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // cria um GameStruct
        // cria um Game
        Game::factory(1)->create();
        // crie os GameMoves
        GameMove::factory(3)->create();
    }
}
