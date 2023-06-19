<?php

namespace Database\Factories;

use App\Enum\StatusGame;
use App\Models\GameStruct;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gameStruct = GameStruct::factory(1)->create();
        return [
            'status' => StatusGame::NotStarted,
            'player1_id' => 1,
            'player2_id' => 2,
            'game_struct_id' => $gameStruct->first()->id,
            'started_game_time' => now()->toTimeString(),
        ];
    }
}
